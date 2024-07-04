<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Slide extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['label'];

    public function categorie()
    {
        return $this->belongsTo('App\Rubrique', 'categorie_id');
    }

    public function getImage()
    {
        if (!$this->image)
            return 'https://via.placeholder.com/300/004c68/FFF?text=Image';
        return asset('/storage/slides/' . $this->image);
    }
}
