<?php

namespace Modules\Esewa\Processor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Esewa\Entities\Esewa;
use Modules\Esewa\Response\EsewaResponse;
use Modules\Gateway\Contracts\{
    PaymentProcessorInterface,
    RequiresCallbackInterface,
    RequiresCancelInterface
};
use Modules\Gateway\Facades\GatewayHelper;

class EsewaProcessor implements PaymentProcessorInterface, RequiresCallbackInterface, RequiresCancelInterface
{
    private $esewa;
    private $helper;
    private $purchaseData;
    private $success_url;
    private $cancel_url;
    private $payload;

    /**
     * Esewa processor constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->helper = GatewayHelper::getInstance();
        $this->purchaseData = $this->helper->getPurchaseData($this->helper->getPaymentCode());
        $this->esewa = Esewa::firstWhere('alias', moduleConfig('esewa.alias'))->data;
    }

    /**
     *  Set initials data
     *
     * @return void
     */
    private function setupData()
    {
        $this->success_url = route('gateway.callback', ['gateway' => moduleConfig('esewa.alias')]);
        $this->cancel_url = route('gateway.cancel', ['gateway' => moduleConfig('esewa.alias')]);
    }


    /**
     *  Set payload data
     *
     * @return void
     */
    private function setPayload()
    {
        $this->payload = array(
            'amount' => $this->purchaseData->total,
            'currency_code' => $this->purchaseData->currency_code,
            'details' => $this->purchaseData->code,
            'mode' => $this->esewa->sandbox,
            'merchantKey' => $this->esewa->merchantKey,
            'success_url' => $this->success_url,
            'cancel_url' => $this->cancel_url,
        );
    }


    /**
     * Ajax payment
     *
     * @param object $request
     * @return payment
     */
    public function pay($request)
    {
        $this->setupData();
        $this->setPayload();

        if (strtoupper($this->purchaseData->currency_code) != 'NPR') {
            throw new \Exception(__('Currency not supported by merchant'));
        }

        Cache::put($this->purchaseData->code, request()->only([
            'to', 'payer', 'code', 'integrity'
        ]), 3600);

        $helper = new EsewaHelper($this->esewa->merchantKey);
        $helper->setRequestData($this->payload)->charge();
    }


    /**
     * Validate Transaction
     *
     * @param Request $request
     * @return EsewaResponse
     */
    public function validateTransaction($request)
    {
        $this->setPayload();
        $queryData = $request->only('oid', 'amt', 'refId') + $this->payload;

        if (!Cache::has($request->oid)) {
            throw new \Exception('Purchase data not found.');
        }

        request()->query->add(Cache::get($request->oid));
        $helper = new EsewaHelper($this->esewa->merchantKey);
        $successCheck = $helper->setTransactionData($queryData)->transactionCharge();
        Cache::forget($queryData['oid']);

        if ($successCheck != "success") {
            throw new \Exception('Transaction data not found.');
        }

        return new EsewaResponse($this->purchaseData, $queryData + array('status' => $successCheck));
    }


    /**
     * Cancel Payment
     *
     * @param object $request
     * @return void
     */
    public function cancel($request)
    {
        throw new \Exception(__('Payment cancelled from Esewa.'));
    }
}
