<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReponseAC as ReponseACResource;


class RubriqueQuestion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $liste = null;
        $model_reponses = [];
        if ($this->type == 'liste') {
            $liste = 'keywords';
            switch ($this->model) {
                case "App\Ville":
                    $liste =  'villes';
                    $NamespacedModel = $this->model;
                    $items = $NamespacedModel::get();
                    $model_reponses = ReponseACResource::collection($items);
                    break;
            }
        }

        $type_label = null;
        if ($this->type) {
            switch ($this->type) {
                case "input":
                    $type_label =  'Zone de texte';
                    break;
                case "textarea":
                    $type_label =  'Long texte';
                    break;
                case "datepicker":
                    $type_label =  'Date';
                    break;
                case "liste":
                    $type_label =  'Liste déroulante';
                    break;
            }
        }

        return [
            'id' => $this->id,
            'label' => $this->label,
            'type' => $this->type,
            'type_label' => $type_label,
            'required' => $this->required,
            'liste' => $liste,
            'model_reponses' => $model_reponses,
            'reponses' => $this->reponses ? explode(':::', $this->reponses) : [],
        ];
    }
}
