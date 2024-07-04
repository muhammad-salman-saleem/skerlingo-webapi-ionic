<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraductionRubrique extends Model
{
    public function child()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('ordre');
    }

    public function parent()
    {
        return $this->belongsTo('App\Rubrique', 'parent_id');
    }
}
