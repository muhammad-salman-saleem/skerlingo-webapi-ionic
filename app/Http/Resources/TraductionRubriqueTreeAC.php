<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Livreur as LivreurResource;

class TraductionRubriqueTreeAC extends JsonResource
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

        if (!$this->parent_id) {
            return [
                'header' => $this->label,
            ];
        } else {

            return [
                'value' => $this->id,
                'text' => $this->label,
                'group' => $this->parent ? $this->parent->label : '',
            ];
        }
    }
}
