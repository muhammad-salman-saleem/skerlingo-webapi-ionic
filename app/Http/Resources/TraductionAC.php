<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Livreur as LivreurResource;

class TraductionAC extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'value' => $this->id,
            'text' => $this->label,
            'id' => $this->id,
            'label' => $this->label,
        ];
    }
}
