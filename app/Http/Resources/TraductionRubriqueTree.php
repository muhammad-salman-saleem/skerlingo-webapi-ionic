<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TraductionRubriqueTree extends JsonResource
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
            'parent_id' => $this->parent_id,
            'parent_label' => $this->parent ? $this->parent->label : '',
            'enable' => $this->enable,
            'opened' => true,
            'children' => TraductionRubriqueTree::collection($this->child),
        ];
    }
}
