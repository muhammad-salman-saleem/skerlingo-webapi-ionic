<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    public function getImage()
    {
        return asset('/storage/actualites/' . $this->image);
    }
}
