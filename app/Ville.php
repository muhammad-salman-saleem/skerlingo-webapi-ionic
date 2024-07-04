<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = [
        'label'
    ];

    public function countAgences()
    {
        return $this->hasMany(Agence::class, 'ville_id')->count();
    }

    public function agences()
    {
        return $this->hasMany(Agence::class, 'ville_id');
    }

    public function countPointsRelais()
    {
        return $this->hasMany(PointRelais::class, 'ville_id')->count();
    }

    public function tarif_destination()
    {
        return $this->hasMany(Tarif::class, 'destination_id');
    }
}
