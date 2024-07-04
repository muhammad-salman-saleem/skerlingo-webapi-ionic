<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RfqStatut extends Model
{

    use HasTranslations;

    public $translatable = ['label'];
}
