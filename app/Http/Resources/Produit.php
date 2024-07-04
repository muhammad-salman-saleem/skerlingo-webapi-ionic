<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Produit extends JsonResource
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


        $tempDate = \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->created_at))->toDateTimeString());
        $tempDateValidationskerlingo = $this->validation_skerlingo_date ? \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->validation_skerlingo_date))->toDateTimeString()) : null;
        $tempDateValidationCompany = $this->validation_entreprise_date ? \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->validation_entreprise_date))->toDateTimeString()) : null;
        $tempDateRefus = $this->refus_date ? \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->refus_date))->toDateTimeString()) : null;

        $results = parent::toArray($request);
        //return parent::toArray($request);
        $data = [
            'id' => isset($this->id) ? $this->id : null,
            'rfqs_count' => isset($this->rfqs_count) ? $this->rfqs_count : null,
            'label' => $this->label,
            'keywords' => $this->keywords ? explode(',', $this->keywords) : [],
            'image' => $this->image,
            'introduction' => $this->introduction,
            'details' => $this->details,
            'secteur_id' => $this->secteur_id,
            'service' => $this->service ? 'oui' : 'non',
            'secteur_label' => $this->secteur ? $this->secteur->label : '',
            'marque_id' => $this->marque_id,
            'marque_image' => $this->marque ? $this->marque->getImage() : '',
            'marque_label' => $this->marque ? $this->marque->label : '',
            'image_url' => $this->getImage(),
            'fiche_url' => $this->getFiche(),
            'url_page' => $this->getUrlAttribute(),
            'caracteristiques' => ProduitCaracteristique::collection($this->caracteristiques),
            'images' => ProduitImage::collection($this->images),
            'date' => $tempDate->format('d/m/Y H:i'),
            'validation_image_skerlingo' => ($this->validation_skerlingo) ? $this->validation_skerlingo->getImage() : '',
            'validation_label_skerlingo' => ($this->validation_skerlingo) ? $this->validation_skerlingo->getNomComplet() : '',
            'validation_date_skerlingo' => $tempDateValidationskerlingo ? $tempDateValidationskerlingo->format('d/m/Y H:i') : null,
            'validation_image_entreprise' => ($this->validation_entreprise) ? $this->validation_entreprise->getImage() : '',
            'validation_label_entreprise' => ($this->validation_entreprise) ? $this->validation_entreprise->getNomComplet() : '',
            'validation_date_entreprise' => $tempDateValidationCompany ? $tempDateValidationCompany->format('d/m/Y H:i') : null,
            'refus_date' => $tempDateRefus ? $tempDateRefus->format('d/m/Y H:i') : null,
        ];

        foreach ($langues as $lang) {
            $data['label_' . $lang['value']] = $this->getTranslation('label', $lang['value'], false);
            $data['introduction_' . $lang['value']] = $this->getTranslation('introduction', $lang['value'], false);
            $data['details_' . $lang['value']] = $this->getTranslation('details', $lang['value'], false);
        }

        return $data;
    }
}
