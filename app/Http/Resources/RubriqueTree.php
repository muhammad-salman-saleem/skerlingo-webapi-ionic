<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RubriqueTree extends JsonResource
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
        $data =  [
            'id' => $this->id,
            'name' => $this->label,
            'text' => $this->label,
            'label' => $this->label,
            'codif' => $this->codif,
            'parent_id' => $this->parent_id,
            'parent_label' => $this->parent ? $this->parent->label : '',
            'parent_url_page' => $this->parent ? $this->parent->getUrlAttribute() : '',
            'montant' => $this->montant ? $this->montant : 0,
            'enable' => $this->enable,
            'show_menu' => $this->show_menu,
            'show_calendar' => $this->show_calendar,
            'first_rubrique' => $this->first_rubrique,
            'icon' => $this->icon,
            'color' => $this->color,
            'opened' => true,
            'presentation' => $this->presentation,
            'description' => $this->description,
            'time_to_deliver' => $this->time_to_deliver,
            'time_to_deliver_label' => $this->time_to_deliver ? ($this->time_to_deliver == 1 ? '24 Heures' : $this->time_to_deliver . ' jours') : '',
            'icon_url' => $this->getIcone(),
            'image_url' => $this->getImage(),
            'children' => RubriqueTree::collection($this->child),
            'url_page' => $this->getUrlAttribute(),
        ];

        foreach ($langues as $lang) {
            $data['text_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['presentation_' . $lang['value']] = $this->getTranslation('presentation', $lang['value'], false);
            $data['description_' . $lang['value']] = $this->getTranslation('description', $lang['value'], false);
        }
        return $data;
    }
}
