<?php

namespace App;

use App\Scopes\AgenceScope;
use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    protected $fillable = [
        'config_id', 'value', 'agence_id'
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
        //static::addGlobalScope(new AgenceScope);
    }

    public function config()
    {
        return $this->belongsTo('App\GeneralConfig', 'config_id');
    }

    public static function getConfig($config_id)
    {
        return AppConfig::where('config_id', $config_id)->first();
    }
}
