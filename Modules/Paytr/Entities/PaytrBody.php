<?php

/**
 * @package Paytr
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 05-04-2023
 */

namespace Modules\Paytr\Entities;

use Modules\Gateway\Entities\GatewayBody;

class PaytrBody extends GatewayBody
{
    /**
     * Paytr merchant id
     *
     * @var string
     */
    public $merchantId;

    /**
     * Paytr merchant key
     *
     * @var string
     */
    public $merchantKey;

    /**
     * Paytr merchant salt
     *
     * @var String
     */
    public $merchantSalt;

    /**
     * Paytr payment instruction 
     *
     * @var String
     */
    public $instruction;

    /**
     * Paytr payment active status
     *
     * @var bool
     */
    public $status;

    /**
     * Paytr payment mode status
     *
     * @var bool
     */
    public $sandbox;

    /**
     * Paytr body constructor
     *
     * @param Object|mixed $request
     * @return void
     */
    public function __construct($request)
    {
        $this->merchantId = $request->merchantId;
        $this->merchantKey = $request->merchantKey;
        $this->merchantSalt = $request->merchantSalt;
        $this->instruction = $request->instruction;
        $this->status = $request->status;
        $this->sandbox = $request->sandbox;
    }
}
