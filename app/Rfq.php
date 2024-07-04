<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Rfq extends Model
{
    public function entreprise()
    {
        return $this->belongsTo('App\Entreprise', 'entreprise_id');
    }

    public function produit()
    {
        return $this->belongsTo('App\Produit', 'produit_id');
    }

    public function statut()
    {
        return $this->belongsTo('App\RfqStatut', 'statut_id');
    }

    public function secteur()
    {
        return $this->belongsTo('App\Rubrique', 'secteur_id');
    }

    public function pays()
    {
        return $this->belongsTo('App\Pays', 'pays_id');
    }

    public function importer()
    {
        return $this->belongsTo('App\User', 'importer_id');
    }

    public function affected_to_exporter()
    {
        return $this->hasMany(RfqEntreprise::class, 'rfq_id')->whereNotNull('sent');
    }

    public function lastMessage()
    {
        return $this->hasMany(RfqMessage::class, 'rfq_id')->whereNull('vu')->orderBy('created_at', 'desc')->first();
    }

    public function messages()
    {
        return $this->hasMany(RfqMessage::class, 'rfq_id');
    }

    public function active_proposals()
    {
        return $this->hasMany(RfqEntreprise::class, 'rfq_id')->whereNotNull('proposal');
    }

    public function active_proposals_count()
    {
        return $this->hasMany(RfqEntreprise::class, 'rfq_id')->whereNotNull('proposal')->count();
    }

    public function getUrlAttribute(): string
    {
        return  route('rfq_page' . (Session::get('locale') ? '_' . Session::get('locale') : ''), [$this->id, $this->alias]);
    }
}
