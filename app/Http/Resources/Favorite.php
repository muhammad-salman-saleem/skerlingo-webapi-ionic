<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Favorite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $lecon = $this->lecon;
        $lettre = $this->lettre;

        //return parent::toArray($request);
        $data =  [
            'user_id' => $this->user_id,
            'lettre_id' => $this->lettre_id,
            'lecon_id' => $this->lecon_id,

            'lecon_label' => $lecon->label,
            'lecon_type' => $lecon->type,
            'lettre_label' => $lettre->label,

            'color' => $lettre->color,
            'illustration' => asset('/assets/mobile/' . $lettre->type . '/' . $lettre->type . '_' . $lettre->romaji . '/' . $lettre->illustration),
            'illustration_letter' => asset('/assets/mobile/' . $lettre->type . '/' . $lettre->type . '_' . $lettre->romaji . '/' . $lettre->illustration_letter),
        ];
        return $data;
    }
}
