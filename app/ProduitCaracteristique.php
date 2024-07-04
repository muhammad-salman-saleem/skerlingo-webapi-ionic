<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProduitCaracteristique extends Model
{

    use HasTranslations;

    public $translatable = ['label', 'value'];

    protected $table = 'produit_caracteristiques';
}
