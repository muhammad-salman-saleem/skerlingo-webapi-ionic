<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lecon extends Model
{
    //
    use HasTranslations;

    public $translatable = ['label', 'introduction', 'description'];
}
