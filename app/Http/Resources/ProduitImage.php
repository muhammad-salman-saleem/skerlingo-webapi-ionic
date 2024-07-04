<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProduitImage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $results = parent::toArray($request);
        //return parent::toArray($request);
        return [
            'id' => isset($this->id) ? $this->id : null,
            'image_url' => $this->getImage(),
            'produit_id' => $this->produit_id,
        ];
    }
}
