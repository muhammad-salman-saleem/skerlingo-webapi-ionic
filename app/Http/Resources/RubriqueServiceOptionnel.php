<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Consultant as ConsultantResource;

class RubriqueServiceOptionnel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $service = $this->service;
        switch ($this->livraison_type) {
            case "up":
                $object['livraison_type'] =  'Agence';
                break;
            case "down":
                $object['livraison_type'] =  'Quartier';
                break;
            case "App\PointRelais":
                $object['livraison_type'] =  'Point relais';
                break;
        }

        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'service_id' => (int) $service->id,
            'service_label' => $service->label,
            'impact_prix' => $this->impact_montant_type ? true : false,
            'impact_montant_type' => $this->impact_montant_type,
            'impact_montant_valeur' => $this->impact_montant_valeur,
            'impact_delai' => $this->impact_delai_type ? true : false,
            'impact_delai_type' => $this->impact_delai_type,
            'impact_delai_valeur' => $this->impact_delai_valeur,
        ];
    }
}
