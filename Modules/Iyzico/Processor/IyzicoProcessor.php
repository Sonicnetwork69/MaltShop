<?php

/**
 * @package Iyzico Martvill
 * @author Md. Mostafijur Rahman <mostafijur.techvill@gmail.ocm>
 * @created 05-09-2023
 */

namespace Modules\Iyzico\Processor;

use Illuminate\Support\Facades\DB;
use Modules\Gateway\Services\GatewayHelper;
use Modules\Iyzico\Entities\Iyzico;
use Modules\Iyzico\Response\IyzicoResponse;
use Modules\Gateway\Contracts\{
    PaymentProcessorInterface,
    RequiresCallbackInterface
};


class IyzicoProcessor implements PaymentProcessorInterface, RequiresCallbackInterface
{

    private $helper;
    private $options;
    private $data;
    private $card_owner;
    private $card_number;
    private $expiration_month;
    private $expiration_year;
    private $cvv;
    private $iyzico;
    private $callbackUrl;



    public function __construct()
    {
        $this->helper = GatewayHelper::getInstance();
    }

    /**
     * Set payment initial data
     */
    private function setupData()
    {

        $this->data = $this->helper->getPurchaseData($this->helper->getPaymentCode());
        $this->iyzico = Iyzico::firstWhere('alias', moduleConfig('iyzico.alias'))->data;
        $this->options = new \Iyzipay\Options();
        $this->options->setApiKey($this->iyzico->apiKey);
        $this->options->setSecretKey($this->iyzico->secretKey);

        if ($this->iyzico->sandbox) {
            $this->options->setBaseUrl('https://sandbox-api.iyzipay.com');
        } else {
            $this->options->setBaseUrl('https://api.iyzipay.com');
        }

        $this->callbackUrl = route('gateway.callback', withOldQueryIntegrity(['gateway' => 'iyzico']));
    }

    /**
     * Payment method.
     */
    public function pay($request)
    {
        $this->setupData();
        $this->card_owner = $request->card_owner;
        $this->card_number = str_replace("-", "", $request->card_number);
        $this->expiration_month = $request->expiration_month;
        $this->expiration_year = $request->expiration_year;
        $this->cvv = $request->cvv;

        $customerInfo = $this->setCustomerInfo();

        if (strtoupper($this->data->currency_code) != 'TRY') {
            throw new \Exception(__('Currency not supported by merchant'));
        }

        $iyzicoRequest = new \Iyzipay\Request\CreatePaymentRequest();
        $iyzicoRequest->setLocale(\Iyzipay\Model\Locale::TR);
        $iyzicoRequest->setConversationId($this->data->code);
        $iyzicoRequest->setPrice(number_format($this->data->total, 2));
        $iyzicoRequest->setPaidPrice(number_format($this->data->total, 2));
        $iyzicoRequest->setCurrency(\Iyzipay\Model\Currency::TL);
        $iyzicoRequest->setInstallment(1);
        $iyzicoRequest->setBasketId(rand(10000, 9999));
        $iyzicoRequest->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
        $iyzicoRequest->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $iyzicoRequest->setCallbackUrl($this->callbackUrl);

        $paymentCard = new \Iyzipay\Model\PaymentCard();
        $paymentCard->setCardHolderName($this->card_owner);
        $paymentCard->setCardNumber($this->card_number);
        $paymentCard->setExpireMonth($this->expiration_month);
        $paymentCard->setExpireYear($this->expiration_year);
        $paymentCard->setCvc($this->cvv);
        $paymentCard->setRegisterCard(0);
        $iyzicoRequest->setPaymentCard($paymentCard);


        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($this->data->id);
        $buyer->setName($customerInfo['firstName']);
        $buyer->setSurname($customerInfo['lastName']);
        $buyer->setGsmNumber($customerInfo['phone']);
        $buyer->setEmail($customerInfo['email']);
        $buyer->setIdentityNumber($this->data->code);
        $buyer->setRegistrationAddress($customerInfo['address']);
        $buyer->setIp(getIpAddress());
        $buyer->setCity($customerInfo['state']);
        $buyer->setCountry($customerInfo['country']);
        $buyer->setZipCode($customerInfo['zip']);
        $iyzicoRequest->setBuyer($buyer);

        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName($customerInfo['name']);
        $shippingAddress->setCity($customerInfo['state']);
        $shippingAddress->setCountry($customerInfo['country']);
        $shippingAddress->setAddress($customerInfo['address']);
        
        $iyzicoRequest->setShippingAddress($shippingAddress);
        $iyzicoRequest->setBillingAddress($shippingAddress);

        $basketItems = array();
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId(rand(1, 9999));
        $firstBasketItem->setName(config('app.name'));
        $firstBasketItem->setCategory1(config('app.name'));
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice(number_format($this->data->total, 2));
        $basketItems[0] = $firstBasketItem;

        $iyzicoRequest->setBasketItems($basketItems);


        $threedsInitialize = \Iyzipay\Model\ThreedsInitialize::create($iyzicoRequest, $this->options);

        if ($threedsInitialize->getStatus() == "failure") {
            throw new \Exception(__($threedsInitialize->getErrorMessage()));
        } else {
            echo $threedsInitialize->getHtmlContent();
        }
    }


    /**
     * Validate transaction
     */
    public function validateTransaction($request)
    {
        $this->setupData();
        return new IyzicoResponse($this->data, $request);
    }

    /**
     * Set Customer info
     */
    private function setCustomerInfo(): array
    {
        $customerData = DB::table('orders_meta')
            ->where('order_id', $this->data->sending_details->id)
            ->pluck('value', 'key')
            ->toArray();

        return [
            'name' => $this->getCustomerName($customerData),
            'phone' => $customerData["shipping_address_phone"] ?? null,
            'email' => $customerData["shipping_address_email"] ?? null,
            'city' => $customerData["shipping_address_city"] ?? null,
            'state' => $customerData["shipping_address_state"] ?? null,
            'country' => $customerData["billing_address_country"] ?? null,
            'zip' => $customerData["billing_address_zip"] ?? null,
            'address' => $this->getCustomerAddress($customerData),
            'firstName' => $customerData["shipping_address_first_name"] ?? null,
            'lastName' => $customerData["shipping_address_last_name"] ?? null,
        ];
    }

    /**
     * Get customer name
     */
    private function getCustomerName(array $data): ?string
    {   
        $array = [];
        if (!empty($data["shipping_address_first_name"])) {
            $array[0] = $data["shipping_address_first_name"];
        }
        if (!empty($data["shipping_address_last_name"])) {
            $array[1] = $data["shipping_address_last_name"];
        }

        return !empty($array) ? implode(' ', $array) : null;
    }

    /**
     * Get customer address
     */
    private function getCustomerAddress(array $data): ?string
    {
        $array = [];
        if (!empty($data["shipping_address_address_1"])) {
            $array[0] = $data["shipping_address_address_1"];
        }
        if (!empty($data["shipping_address_city"])) {
            $array[1] = $data["shipping_address_city"];
        }

        return !empty($array) ? implode(' ', $array) : null;
    }
}
