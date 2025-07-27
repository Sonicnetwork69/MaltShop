<?php

/**
 * @package PaytrResponse
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 06-04-23
 */

namespace Modules\Paytr\Response;

use Modules\Gateway\Contracts\{
    CryptoResponseInterface,
    HasDataResponseInterface
};
use Modules\Gateway\Response\Response;

class PaytrResponse extends Response implements HasDataResponseInterface, CryptoResponseInterface
{
    protected $response;
    private $data;
    public $unique;
    public $params;

    /**
     * Constructor of the response
     *
     * @param object $data (Order data object)
     * @param object $response (Payment response)
     */
    public function __construct($data, $response)
    {
        $this->data = $data;
        $this->response = $response;
        $this->updateStatus();
        return $this;
    }


    /**
     * Get Raw Response
     *
     * @return string
     */
    public function getRawResponse(): string
    {
        return json_encode($this->response);
    }


    /**
     * Update Payment Status
     *
     * @return void
     */
    protected function updateStatus()
    {
        if ($this->response['status'] == 'success') {
            $this->setPaymentStatus('pending');
        } else {
            $this->setPaymentStatus('failed');
        }
    }


    /**
     * Get Response
     *
     * @return string
     */
    public function getResponse(): string
    {
        return json_encode($this->getSimpleResponse());
    }

    /**
     * Get Simple Response
     *
     * @return array
     */
    private function getSimpleResponse()
    {
        return [
            'amount' => $this->data->total,
            'amount_captured' => $this->data->total,
            'currency' => $this->data->currency_code,
            'code' => $this->data->code
        ];
    }

    /**
     * Get Gateway
     *
     * @return string
     */
    public function getGateway(): string
    {
        return 'paytr';
    }


    /**
     * Set payment status
     * 
     * @param string $status
     * @return void
     */
    public function setPaymentStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Set a unique code returned by the gateway while creating payment request/transaction
     */
    public function setUniqueCode($code)
    {
        $this->unique = $code;
    }

    /**
     * get a unique code
     *
     * @return string
     */
    public function getUniqueCode()
    {
        return $this->unique;
    }

    /**
     * get url
     *
     * @return url
     */
    public function getUrl()
    {
        return route('paytr.show', withOldQueryIntegrity(['token' => $this->response['token']]));
    }

    /**
     * Set params
     *
     * @param Array $array
     * @return void
     */
    public function setParams($array)
    {
        $this->params = $array;
    }

    /**
     * get params
     *
     * @return params
     */
    public function getParams()
    {
        return $this->params;
    }
}
