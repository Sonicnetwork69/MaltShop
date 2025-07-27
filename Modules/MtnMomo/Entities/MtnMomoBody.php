<?php

/**
 * @package MtnMomo
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 12-02-2023
 */

namespace Modules\MtnMomo\Entities;

use Modules\Gateway\Entities\GatewayBody;

class MtnMomoBody extends GatewayBody
{
    public $userApiId;
    public $userApiKey;
    public $ocpApimSubscriptionKey;
    public $instruction;
    public $status;
    public $sandbox;
    public $country;


    public function __construct($request)
    {
        $this->userApiId = $request->userApiId;
        $this->userApiKey = $request->userApiKey;
        $this->ocpApimSubscriptionKey = $request->ocpApimSubscriptionKey;
        $this->instruction = $request->instruction;
        $this->status = $request->status;
        $this->sandbox = $request->sandbox;
        $this->country = $request->country;
    }
}
