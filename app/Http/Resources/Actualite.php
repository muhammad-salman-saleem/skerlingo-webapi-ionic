<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Professeur as ProfesseurResource;

class Actualite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        \Carbon\Carbon::setLocale('en');
        $tempDate = \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->date))->toDateTimeString());

        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'label' => $this->label,
            'intro' => $this->intro,
            'description' => $this->description,
            'enabled' => $this->enabled,
            'date' => $this->date,
            'date_format' => $tempDate->format('d-m-Y'),
            'image_url' => $this->getImage(),
        ];
    }
}
