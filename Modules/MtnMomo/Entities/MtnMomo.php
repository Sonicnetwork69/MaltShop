<?php

/**
 * @package MtnMomo
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 12-02-2023
 */

namespace Modules\MtnMomo\Entities;

use Modules\Gateway\Entities\Gateway;
use Modules\MtnMomo\Scope\MtnMomoScope;

class MtnMomo extends Gateway
{

    protected $table = 'gateways';
    protected $appends = ['image_url'];

    protected static function booted()
    {
        static::addGlobalScope(new MtnMomoScope);
    }
}
