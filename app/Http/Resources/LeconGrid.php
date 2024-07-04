<?php

namespace App\Http\Resources;

use App\Http\Resources\Lettre as ResourcesLettre;
use App\Lettre;
use Illuminate\Http\Resources\Json\JsonResource;

class LeconGrid extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  [
            'id' => $this->id,
            'label' => $this->label,
        ];

        $lettres = LettreGrid::collection(Lettre::where('lecon_id', $this->id)->get());

        $data['lettres'] = $lettres;

        return $data;
    }
}
