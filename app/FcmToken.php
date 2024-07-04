<?php

namespace App;

use App\Scopes\AgenceScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FcmToken extends Model
{
    protected $fillable = [
        'token', 'client_id', 'agence_id'
    ];

    protected static function boot()
    {
        parent::boot();

        $agence_id = AgenceScope::$key_agence;
        static::creating(function ($query) use ($agence_id) {
            $query->agence_id = $agence_id;
        });
    }

    protected static function booted()
    {
        static::addGlobalScope(new AgenceScope);
    }
}
