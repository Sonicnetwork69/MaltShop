<?php

/**
 * @package VoguePayResponse
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 24-01-23
 */

namespace Modules\VoguePay\Response;

use Modules\Gateway\Contracts\HasDataResponseInterface;
use Modules\Gateway\Response\Response;

class VoguePayResponse extends Response implements HasDataResponseInterface
{
    protected $response;
    private $data;


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
        if ($this->response->status == "Approved") {
            $this->setPaymentStatus('completed');
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
            'amount_captured' => $this->response->total,
            'currency' => $this->response->cur,
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
        return 'VoguePay';
    }

    /**
     * Set Payment Status
     *
     * @param string $status
     * @return void
     */

    protected function setPaymentStatus($status)
    {
        $this->status = $status;
    }
}
