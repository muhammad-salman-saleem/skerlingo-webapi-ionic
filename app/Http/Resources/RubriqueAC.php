<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Livreur as LivreurResource;

class RubriqueAC extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $langues = [];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];
        $langues[] = ['value' => 'it', 'text' => 'Italie'];
        $langues[] = ['value' => 'ar', 'text' => 'Arabe'];

        //return parent::toArray($request);
        $data = [
            'value' => $this->id,
            'text' => $this->label,
            'presentation' => $this->presentation,
            'description' => $this->description,
            'id' => $this->id,
            'label' => $this->label,
            'avatar' => $this->getImage(),
            'parent_url_page' => $this->parent ? $this->parent->getUrlAttribute() : '',
            'parent_label' => $this->parent ? $this->parent->label : '',
            'url_page' => $this->getUrlAttribute(),
            'montant' => $this->montant ? $this->montant : 0,
            'time_to_deliver' => $this->time_to_deliver,
        ];

        foreach ($langues as $lang) {
            $data['text_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['presentation_' . $lang['value']] = $this->getTranslation('presentation', $lang['value'], false);
            $data['description_' . $lang['value']] = $this->getTranslation('description', $lang['value'], false);
        }
        return $data;
    }
}
