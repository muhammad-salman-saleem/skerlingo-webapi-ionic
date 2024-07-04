<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TraductionTree extends JsonResource
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
            'name' => $this->label,
            'text' => $this->label,
            'label' => $this->label,
            'type' => $this->type,
            'value' => $this->getTranslation('value', app()->getLocale()),
            'rubrique_id' => $this->rubrique_id,
            'rubrique_label' => $this->rubrique ? $this->rubrique->label : '',
            'enable' => $this->enable,
            'opened' => true,
            'children' => [],
        ];
    }
}
