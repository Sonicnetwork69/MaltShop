<?php

/**
 * @package PaytrProcessor
 * @author techvillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 06-04-23
 */

namespace Modules\Paytr\Processor;

use Modules\Gateway\Services\GatewayHelper;
use Modules\Paytr\Response\PaytrResponse;
use Modules\Paytr\Entities\Paytr;
use Modules\Gateway\Contracts\{
    PaymentProcessorInterface,
    RequiresCallbackInterface,
    RequiresCancelInterface,
    RequiresWebHookValidationInterface
};
use Modules\Gateway\Entities\PaymentLog;

class PaytrProcessor implements PaymentProcessorInterface, RequiresWebHookValidationInterface, RequiresCallbackInterface, RequiresCancelInterface
{
    /**
     * Paytr credentials
     *
     * @var Object/array
     */
    private $paytr;

    /**
     * Gateway helper instance
     *
     * @var [type]
     */
    private $helper;

    /**
     * Customer email
     *
     * @var String
     */
    private $email;

    /**
     * Paytr sending payload
     *
     * @var Array
     */
    private $payload;

    /**
     * Customer purchase data
     *
     * @var Object/Array
     */
    private $purchaseData;

    /**
     * Paytr token
     *
     * @var String
     */
    public $token;

    /**
     * Paytr request url
     *
     * @var String
     */
    private $requestUrl;

    /**
     * Customer address
     *
     * @var String
     */
    private $userAddress;

    /**
     * Customer phone number
     *
     * @var String
     */
    private $userPhone;

    /**
     * Customer name
     *
     * @var String
     */
    private $username;

    /**
     * Order id
     *
     * @var String
     */
    private $merchantOid;

    /**
     * Payment success url
     *
     * @var String
     */
    private $successUrl;

    /**
     * Payment fail url
     *
     * @var String
     */
    private $failUrl;

    /**
     * User ip address
     *
     * @var String
     */
    private $userIp;

    /**
     * Paytr time out limit
     *
     * @var integer
     */
    private $timeout;

    /**
     * Paytr debug mode
     *
     * @var integer
     */
    private $debug = 1;

    /**
     * Paytr payment mode (test mode or production mode)
     *
     * @var integer
     */
    private $testMode = 0;

    /**
     * order contents
     *
     * @var string
     */
    private $userBasket;

    /**
     * Undocumented variable
     *
     * @var integer
     */
    private $noInstallment = 1;

    /**
     * Maximum number of installments
     *
     * @var integer
     */
    private $maxInstallment = 0;

    /**
     * Hash data for paytr
     *
     * @var String
     */
    private $hashString;

    /**
     * Encrypted token
     *
     * @var string
     */
    private $paytrToken;

    /**
     * Payment amount
     *
     * @var integer
     */
    private $total;


    /**
     * Paytr processor constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->helper = GatewayHelper::getInstance();
        $this->paytr = Paytr::firstWhere('alias', moduleConfig('paytr.alias'))->data;
        $this->purchaseData = $this->helper->getPurchaseData($this->helper->getPaymentCode());
    }

    /*
    *   GENERATE PRIVACY HASH CODE
    */
    public function generateHashCode()
    {
        $this->hashString = implode("", [
            $this->paytr->merchantId,
            $this->userIp,
            $this->merchantOid,
            $this->email,
            $this->total,
            $this->userBasket,
            $this->noInstallment,
            $this->maxInstallment,
            $this->purchaseData->currency_code,
            $this->testMode,
            $this->paytr->merchantSalt
        ]);
    }

    /**
     * Set paytr token
     *
     * @return void
     */
    public function setPaytrToken()
    {
        $this->paytrToken = base64_encode(techHash($this->hashString, $this->paytr->merchantKey));
    }


    /**
     *  Generate random unique key
     *
     * @return key
     */
    public function randomKeyGenerate()
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 50);
    }

    public function requestPaytr($postValues = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postValues);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = @curl_exec($ch);
        if (curl_errno($ch)) {
            curl_close($ch);
            return curl_error($ch);
        } else {
            curl_close($ch);
            return $result;
        }
    }

    /**
     *  Set initials data
     *
     * @return void
     */
    private function setupData()
    {

        $this->successUrl = route(techDecrypt(request()->to), withOldQueryIntegrity());
        $this->failUrl = route('gateway.cancel', withOldQueryIntegrity(['gateway' => 'paytr']));
        $this->merchantOid = $this->randomKeyGenerate();
        $this->userIp = getIpAddress();
        $this->total = intval($this->purchaseData->total * 100);
        $this->timeout = 30;
        $this->setEnvironment();
        $this->setBasket();
    }


    /**
     *  Set payload data
     *
     * @return void
     */
    private function setPayload()
    {
        $this->payload = [
            'merchant_id'        => $this->paytr->merchantId,
            'user_ip'            => $this->userIp,
            'merchant_oid'       => $this->merchantOid,
            'email'              => $this->email,
            'payment_amount'     => $this->total,
            'paytr_token'        => $this->paytrToken,
            'user_basket'        => $this->userBasket,
            'debug_on'           => $this->debug,
            'no_installment'     => $this->noInstallment,
            'max_installment'    => $this->maxInstallment,
            'user_name'          => $this->username,
            'user_address'       => $this->userAddress,
            'user_phone'         => $this->userPhone,
            'merchant_ok_url'    => $this->successUrl,
            'merchant_fail_url'  => $this->failUrl,
            'timeout_limit'      => $this->timeout,
            'currency'           => $this->purchaseData->currency_code,
            'test_mode'          => $this->testMode
        ];
    }


    /**
     * Ajax payment
     *
     * @param object $request
     * @return payment view
     */
    public function pay($request)
    {
        if (!$request->name) {
            throw new \Exception(__('Name is required.'));
        }

        $this->username = $request->name;

        if (!$request->email) {
            throw new \Exception(__('Email is required.'));
        }

        $this->email = $request->email;

        if (!$request->phone) {
            throw new \Exception(__('Phone number is required.'));
        }

        $this->userPhone = $request->phone;

        if (!$request->address) {
            throw new \Exception(__('Address is required.'));
        }

        $this->userAddress = $request->address;
        $this->setupData();
        if (!$this->isSupportCurrency()) {
            throw new \Exception(__('The selected currency is not supported by this merchant.'));
        }

        $this->generateHashCode();
        $this->setPaytrToken();
        $this->setPayload();
        $result = $this->requestPaytr($this->payload);
        $result = json_decode($result, 1);
        if ($result['status'] != 'success') {

            throw new \Exception($result['reason']);
        }
        $response = new PaytrResponse($this->purchaseData, $result);
        $response->setUniqueCode($this->merchantOid);
        $response->setPaymentStatus('pending');

        return $response;
    }


    /**
     * Validate Transaction
     *
     * @param Request $request
     * @return PaytrResponse
     */
    public function validateTransaction($request)
    {
        return new PaytrResponse($this->purchaseData, $request);
    }


    /**
     * Cancel Payment
     *
     * @param object $request
     * @return void
     */
    public function cancel($request)
    {
        throw new \Exception(__('Payment cancelled from Paytr.'));
    }


    /**
     * Set environment
     *
     * @return void
     */
    private function setEnvironment()
    {
        if (!$this->paytr->sandbox) {
            $this->testMode = 1;
            $this->debug = 0;
        }

        $this->setUrl();
    }


    /**
     * Set Urls
     *
     * @return void
     */
    private function setUrl()
    {
        $this->requestUrl = "https://www.paytr.com/odeme/api/get-token";
    }

    /*
    * Set user basket(product) info
    *
    * @return void
    */
    public function setBasket()
    {
        $this->userBasket = base64_encode(json_encode(array(
            array($this->purchaseData->code, $this->total, 1),
        )));
    }

    /**
     * Check currency support or not
     *
     * @return boolean
     */
    private function isSupportCurrency()
    {
        return in_array(strtoupper($this->purchaseData->currency_code), moduleConfig('paytr.supportCurrencies'));
    }

    public function validatePayment($request)
    {
        $hash = base64_encode(techHash($request->merchantOid . $this->paytr->merchant_salt . $request->status . $request->total_amount, $this->paytr->merchant_key));

        if ($hash == $request->hash && $request->status == 'success') {

            $payment = PaymentLog::uniqueCode($request->externalId)->first();

            if (!$payment) {
                paymentLog($request);
                paymentLog('------ Payment data with the requested paytr unique code ("field: custom") -------');
                return false;
            }

            $payment->response_raw = json_encode($request->all());

            if ($request->status == 'success') {

                $payment->status = 'completed';
                $payment->response = json_encode($request->all());
            } else {
                $payment->status = 'cancelled';
            }

            $payment->store();

            return true;
        }
        return false;
    }

}
