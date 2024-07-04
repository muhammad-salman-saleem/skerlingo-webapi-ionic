<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPost extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type = $this->type;
        $tempDate = \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->created_at))->toDateTimeString());
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'value' => $this->id,
            'label' => $this->label,
            'intro' => $this->intro,
            'contenu' => $this->contenu,
            'type_id' => $this->type_id,
            'type_label' => $type ? $type->label : '',
            'url_page' => $this->getUrlAttribute(),
            'image_url' => $this->getImage(),
            'date' => $tempDate->format('d M Y'),
        ];
    }
}
