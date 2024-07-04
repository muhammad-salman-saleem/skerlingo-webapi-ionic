<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Spatie\Translatable\HasTranslations;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Produit extends Model implements Searchable
{

    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['label', 'introduction', 'details'];

    public function rfqs()
    {
        return $this->hasMany(Rfq::class, 'produit_id');
    }

    public function marque()
    {
        return $this->belongsTo('App\Marque', 'marque_id');
    }

    public function secteur()
    {
        return $this->belongsTo('App\Rubrique', 'secteur_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'creation_user');
    }

    public function getImage()
    {
        if (!$this->image)
            return 'https://via.placeholder.com/300/004c68/FFF?text=Image';
        return asset('/storage/produits/' . $this->image);
    }


    public function getFiche()
    {
        if (!$this->fiche)
            return null;
        return asset('/storage/produits/' . $this->fiche);
    }

    public function secteurs()
    {
        return $this->belongsToMany(Rubrique::class, 'livreur_ville');
    }

    public function secteursIds()
    {
        return $this->secteurs->modelKeys();
    }

    public function validation_skerlingo()
    {
        return $this->belongsTo('App\User', 'validation_skerlingo_user');
    }

    public function validation_entreprise()
    {
        return $this->belongsTo('App\User', 'validation_entreprise_user');
    }

    public function caracteristiques()
    {
        return $this->hasMany(ProduitCaracteristique::class, 'produit_id');
    }

    public function caracteristiquesIds()
    {
        return $this->caracteristiques->modelKeys();
    }

    public function images()
    {
        return $this->hasMany(ProduitImage::class, 'produit_id');
    }

    public function imagesIds()
    {
        return $this->images->modelKeys();
    }

    public function getUrlAttribute(): string
    {
        return  route('produit_page' . (Session::get('locale') ? '_' . Session::get('locale') : ''), [$this->id, $this->alias]);
    }

    public function getSearchResult(): SearchResult
    {
        $url = $this->slug;

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->label,
            $url
        );
    }
}
