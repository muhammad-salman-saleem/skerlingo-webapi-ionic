<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lettre extends Model
{
    //
    use HasTranslations;

    public $translatable = ['label', 'description'];


    public function exemples()
    {
        return $this->hasMany(LettreExemple::class, 'lettre_id')->where('type', $this->type);
    }

    public function quizLettre($user_id)
    {
        return QuizLettre::where('user_id', $user_id)->where('lettre_id', $this->id)->first();
    }
}
