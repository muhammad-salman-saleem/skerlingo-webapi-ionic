<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lettre extends JsonResource
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

        $traits = [];
        for ($i = 1; $i <= $this->stroke; $i++) {
            $traits[] = asset('/assets/mobile/ordre-trait/' . $this->type . '/' . $this->romaji . $i . '.svg');
        }

        //return parent::toArray($request);
        $data =  [
            'id' => $this->id,
            'value' => $this->id,
            'label' => $this->label,
            'text' => $this->label,
            'romaji' => $this->romaji,
            'kana' => $this->kana,
            'stars' => $this->stars,
            'description' => $this->description,
            'exemples' => LettreExemple::collection($this->exemples),
            'traits' => $traits,
            'color' => $this->color,
            'illustration' => asset('/assets/mobile/' . $this->type . '/' . $this->type . '_' . $this->romaji . '/' . $this->illustration),
            'illustration_letter' => asset('/assets/mobile/' . $this->type . '/' . $this->type . '_' . $this->romaji . '/' . $this->illustration_letter),
            'audio' => asset('/assets/mobile/audio/' . $this->prononciation),
        ];

        foreach ($langues as $lang) {
            $data['text_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['label_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['description_' . $lang['value']] = $this->getTranslation('description', $lang['value'], false);
        }
        return $data;
    }
}
