<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LettreExemple extends Model
{
    use HasTranslations;

    public $translatable = ['label'];


    public function lettre()
    {
        return $this->belongsTo('App\Lettre', 'lettre_id');
    }
}
