<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogType extends Model
{
    //
    use HasTranslations;

    public $translatable = ['label'];
}
