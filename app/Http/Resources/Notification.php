<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
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
            'id' => $this->id,
            'sujet' => $this->sujet,
            'message' => $this->message,
            'nombre_sent' => $this->nombre_sent,
            'nombre_done' => $this->nombre_done,
        ];
    }
}
