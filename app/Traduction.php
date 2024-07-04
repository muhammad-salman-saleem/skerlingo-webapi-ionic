<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Traduction extends Model
{
    use HasTranslations;

    public $translatable = ['value'];

    public function rubrique()
    {
        return $this->belongsTo('App\TraductionRubrique', 'rubrique_id');
    }
}
