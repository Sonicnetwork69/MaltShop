<?php

/**
 * @package VoguePayProcessor
 * @author techvillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 24-01-23
 */

namespace Modules\VoguePay\Processor;

use Modules\Gateway\Contracts\{
    PaymentProcessorInterface,
    RequiresCallbackInterface,
    RequiresCancelInterface
};
use Modules\VoguePay\Response\VoguePayResponse;
use Modules\Gateway\Services\GatewayHelper;
use Modules\VoguePay\Entities\VoguePay;

class VoguePayProcessor implements PaymentProcessorInterface, RequiresCallbackInterface, RequiresCancelInterface
{
    private $voguePay;
    private $helper;
    private $email;
    private $data;
    private $notifyUrl;
    private $successUrl;
    private $failUrl;
    private $developerCode;
    private $validatePayload;
    private $payload;
    private $sandbox;

    /**
     * vogue pay constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->helper = GatewayHelper::getInstance();
    }

    /**
     * Setup the initials value
     *
     * @return void
     */
    private function setupData()
    {
        $this->data = $this->helper->getPurchaseData($this->helper->getPaymentCode());
        $this->voguePay = VoguePay::firstWhere('alias', moduleConfig('voguepay.alias'))->data;
        $this->notifyUrl = route('gateway.callback', withOldQueryIntegrity(['gateway' => 'voguepay']));
        $this->successUrl = route('gateway.callback', withOldQueryIntegrity(['gateway' => 'voguepay']));
        $this->failUrl = route('gateway.cancel', withOldQueryIntegrity(['gateway' => 'voguepay']));
        $this->developerCode = moduleConfig('voguepay.developerCode');
        $this->sandbox = $this->voguePay->sandbox == 1 ? true : false;

    }

    /**
     * Setup the payload values
     *
     * @return void
     */
    private function setPayload()
    {
        $this->payload = array(
            'p' => 'linkToken',
            'v_merchant_id' => $this->voguePay->merchantId,
            'memo' => $this->data->code,
            'total' => $this->data->total,
            'email' => $this->email,
            'merchant_ref' => 'MV'.time(),
            'notifyUrl' => $this->notifyUrl,
            'successUrl' => $this->successUrl,
            'failUrl' => $this->failUrl,
            'developerCode' => $this->developerCode,
            'cur' => $this->data->currency_code,
        );
    }

    /**
     * Payment function
     *
     * @param array|mix $request
     * @return String $response
     */
    public function pay($request)
    {
        if (!$request->email) {
            throw new \Exception('Email is required!');
        }
        $this->email = $request->email;

        $this->setupData();
        $this->setPayload();

        $response = $this->callToApi($this->payload, $this->sandbox);

        return redirect($response);
    }

    /**
     * Verify payment transaction
     *
     * @param array|mix $request
     * @return array|mix $response
     */
    public function validateTransaction($request)
    {
        $this->setupData();

        $transaction_id = $request->transaction_id;

        if (!$transaction_id) {
            throw new \Exception('No transaction supplied.');
        }

        $this->setValidatePayload($request);

        $curlResponse = $this->callToApi($this->validatePayload, $this->sandbox);

        $transaction = json_decode($curlResponse);

        if (!$transaction->status) {
            throw new \Exception($transaction->message);
        }

        if ('Approved' <> $transaction->status) {
            throw new \Exception('Validation Failed.');
        }

        return new VoguePayResponse($this->data, $transaction);
    }


    /**
     * Cancel Payment
     *
     * @param object $request
     * @return void
     */
    public function cancel($request)
    {
        throw new \Exception(__('Payment cancelled from Vogue pay.'));
    }


    /**
     * Call API
     * @param $payload
     * @param bool $setLocalhost
     * @param array $header
     * @return bool|string
     */
    public function callToApi($payload, $setLocalhost = true, $header = [])
    {
        $curl = curl_init();
        if (!$setLocalhost) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        } else {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }

        curl_setopt($curl, CURLOPT_URL, 'https://pay.voguepay.com/?' . http_build_query($payload));
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlErrorNo = curl_errno($curl);
        curl_close($curl);

        if ($code == 200 & !($curlErrorNo)) {
            return $response;
        }

        throw new \Exception(__('Failed to connect with vogue pay.'));
    }


    /**
     * Set validation data
     *
     * @param object $request
     * @return void
     */

    private function setValidatePayload($request)
    {
        $this->validatePayload = array(
            'v_transaction_id' => $request->transaction_id,
            'v_merchant_id' => $this->voguePay->merchantId,
            'type' => 'json',
        );
    }

}
