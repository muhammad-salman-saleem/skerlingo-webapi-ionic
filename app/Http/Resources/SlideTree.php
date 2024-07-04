<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Livreur as LivreurResource;

class SlideTree extends JsonResource
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


        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $data =  [
            'id' => $this->id,
            'name' => $this->label,
            'text' => $this->label,
            'label' => $this->label,
            'categorie_id' => $this->categorie_id,
            'icon' => $this->image,
            'opened' => true,
            'image_url' => $this->getImage(),
            'children' => [],
        ];

        foreach ($langues as $lang) {
            $data['text_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
        }

        return $data;
    }
}
