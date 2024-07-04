<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    public function lecon()
    {
        return $this->belongsTo(Lecon::class, 'lecon_id');
    }

    public function lettre()
    {
        return $this->belongsTo(Lettre::class, 'lettre_id');
    }
}
