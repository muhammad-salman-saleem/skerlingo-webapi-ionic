<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AgenceScope implements Scope
{
    public static $agence;
    public static $key_agence;

    public static function setKeyAgence($key_agence)
    {
        AgenceScope::$key_agence = $key_agence;
    }

    public static function setAgence($agence)
    {
        AgenceScope::$agence = $agence;
    }

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getTable() . '.sys_agence', AgenceScope::$key_agence);
    }
}
