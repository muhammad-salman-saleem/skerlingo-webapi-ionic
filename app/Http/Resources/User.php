<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $object = parent::toArray($request);
        $object['id'] = $this->id;
        $object['nomComplet'] = $this->nom . ' ' . $this->prenom;
        $object['nom'] = $this->nom;
        $object['prenom'] = $this->prenom;
        $object['email'] = $this->email;
        $object['tel'] = $this->tel;
        $object['image'] = $this->image;
        $object['image_url'] = $this->getImage();
        $object['cni'] = $this->cni ? $this->cni : '';
        $object['fonction'] = $this->fonction ? $this->fonction : '';
        return $object;
    }
}
