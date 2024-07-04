<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Session;

class Rubrique extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['label', 'presentation', 'description'];

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('ordre');
    }

    public function parent()
    {
        return $this->belongsTo('App\Rubrique', 'parent_id');
    }

    public function getIcone()
    {
        if (!$this->icon)
            return 'https://via.placeholder.com/300/004c68/FFF?text=Logo';
        return asset('/storage/rubriques/' . $this->icon);
    }

    public function getImage()
    {
        if (!$this->image)
            return 'https://via.placeholder.com/300/004c68/FFF?text=Image';
        return asset('/storage/rubriques/' . $this->image);
    }

    public function questions()
    {
        return $this->hasMany(RubriqueQuestion::class, 'rubrique_id');
    }

    public function getUrlAttribute(): string
    {
        /*
        if (!$this->parent_id)
            return  route('service_page' . (Session::get('locale') ? '_' . Session::get('locale') : ''), [$this->id, $this->alias]);
            */
        return  route('products_category_page' . (Session::get('locale') ? '_' . Session::get('locale') : ''), [$this->id, $this->alias]);

        return  route('service_page' . (Session::get('locale') ? '_' . Session::get('locale') : ''), [$this->id, $this->alias]);
    }
}
