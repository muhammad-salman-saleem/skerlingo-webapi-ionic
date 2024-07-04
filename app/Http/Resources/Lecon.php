<?php

namespace App\Http\Resources;

use App\Http\Resources\Lettre as ResourcesLettre;
use App\Lettre;
use Illuminate\Http\Resources\Json\JsonResource;

class Lecon extends JsonResource
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

        //return parent::toArray($request);
        $data =  [
            'id' => $this->id,
            'value' => $this->id,
            'label' => $this->label,
            'text' => $this->label,
            'letter' => $this->letter,
            'introduction' => $this->introduction,
            'description' => $this->description,
        ];


        $lettres = ResourcesLettre::collection(Lettre::where('lecon_id', $this->id)->get());

        $data['lettres'] = $lettres;

        foreach ($langues as $lang) {
            $data['text_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['label_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['introduction_' . $lang['value']] = $this->getTranslation('introduction', $lang['value'], false);
            $data['description_' . $lang['value']] = $this->getTranslation('description', $lang['value'], false);
        }
        return $data;
    }
}
