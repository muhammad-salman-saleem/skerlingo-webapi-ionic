<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LettreGrid extends JsonResource
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
        $data =  [
            'id' => $this->id,
            'label' => $this->label,
            'romaji' => $this->romaji,
            'color' => $this->color,
            'kana' => $this->kana,
            'illustration' => asset('/assets/mobile/' . $this->type . '/' . $this->type . '_' . $this->romaji . '/' . $this->illustration),
            'illustration_letter' => asset('/assets/mobile/' . $this->type . '/' . $this->type . '_' . $this->romaji . '/' . $this->illustration_letter),
        ];
        return $data;
    }
}
