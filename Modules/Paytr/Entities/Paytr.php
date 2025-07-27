<?php

/**
 * @package Paytr
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 05-04-2023
 */

namespace Modules\Paytr\Entities;

use Modules\Paytr\Scope\PaytrScope;
use Modules\Gateway\Entities\Gateway;


class Paytr extends Gateway
{

    protected $table = 'gateways';
    protected $appends = ['image_url'];

    /**
     * Global scope for paytr
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new PaytrScope);
    }
}
