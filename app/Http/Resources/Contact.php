<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $tempDate = \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->created_at))->toDateTimeString());
        $data =  [
            'id' => $this->id,
            'type' => $this->ville ? 'Inscription' : 'Téléchargement',
            'nom_complet' => $this->nom . ' ' . $this->prenom,
            'email' => $this->email,
            'tel' => $this->tel,
            'ville' => $this->ville,
            'company' => $this->company,
            'poste' => $this->fonction,
            'date' => $tempDate->format('d/m/Y H:i'),
        ];

        return $data;
    }
}
