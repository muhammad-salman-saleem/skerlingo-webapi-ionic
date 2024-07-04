<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationTree extends JsonResource
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
            'name' => $this->config->label,
            'text' => $this->config->label,
            'label' => $this->config->label,
            'type' => 'input',
            'value' => $this->value,
            'children' => [],
        ];
    }
}
