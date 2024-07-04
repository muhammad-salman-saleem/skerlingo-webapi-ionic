<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduitImage extends Model
{

    public function getImage()
    {
        if (!$this->image)
            return 'https://via.placeholder.com/300/004c68/FFF?text=Image';
        return asset('/storage/produits/' . $this->image);
    }
}
