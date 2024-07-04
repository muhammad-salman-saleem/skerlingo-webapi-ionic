<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProduitCaracteristique extends JsonResource
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
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $results = parent::toArray($request);
        //return parent::toArray($request);
        $data = [
            'id' => isset($this->id) ? $this->id : null,
            'label' => $this->label,
            'value' => $this->value,
        ];

        foreach ($langues as $lang) {
            $data['label_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['value_' . $lang['value']] = $this->getTranslation('value', $lang['value'], false);
        }

        return $data;
    }
}
