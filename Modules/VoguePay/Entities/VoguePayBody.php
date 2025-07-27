<?php

/**
 * @package VoguePay
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 24-01-2023
 */

namespace Modules\VoguePay\Entities;

use Modules\Gateway\Entities\GatewayBody;

class VoguePayBody extends GatewayBody
{
    public $merchantId;
    public $instruction;
    public $status;
    public $sandbox;

    /**
     * Vogue pay body Constructor
     *
     * @param object $request
     * @return void
     */
    public function __construct($request)
    {
        $this->merchantId = $request->merchantId;
        $this->instruction = $request->instruction;
        $this->status = $request->status;
        $this->sandbox = $request->sandbox;
    }
}
