<?php

/**
 * @package VoguePay
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 24-01-2023
 */

namespace Modules\VoguePay\Entities;

use Modules\Gateway\Entities\Gateway;
use Modules\VoguePay\Scope\VoguePayScope;

class VoguePay extends Gateway
{

    protected $table = 'gateways';
    protected $appends = ['image_url'];

    protected static function booted()
    {
        static::addGlobalScope(new VoguePayScope);
    }
}
