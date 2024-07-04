<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Livreur as LivreurResource;

class SlideAC extends JsonResource
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
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];

        //return parent::toArray($request);
        $data = [
            'value' => $this->id,
            'text' => $this->label,
            'id' => $this->id,
            'label' => $this->label,
            'icon' => $this->image,
            'avatar' => $this->getImage(),
            'image_url' => $this->getImage(),
            'categorie_id' => (int) $this->categorie_id,
            'categorie_label' => $this->categorie ? $this->categorie->label : '',
            'categorie_url' => $this->categorie ? $this->categorie->getUrlAttribute() : '#',
        ];

        foreach ($langues as $lang) {
            $data['text_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
        }
        return $data;
    }
}
