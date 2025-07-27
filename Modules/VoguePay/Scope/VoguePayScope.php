<?php

/**
 * @package VoguePay
 * @author TechVillage <support@techvill.org>
 * @contributor Md. Mostafijur Rahman <[mostafijur.techvill@gmail.com]>
 * @created 24-01-23
 */

namespace Modules\VoguePay\Scope;

use Illuminate\Database\Eloquent\{
    Builder,
    Model,
    Scope
};

class VoguePayScope implements Scope
{
    /**
     * Scope Apply
     * 
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('alias', 'voguepay');
    }
}
