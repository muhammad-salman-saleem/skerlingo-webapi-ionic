<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqMessage extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function rfq_entreprise()
    {
        return $this->belongsTo('App\RfqEntreprise', 'rfq_entreprise_id');
    }
}
