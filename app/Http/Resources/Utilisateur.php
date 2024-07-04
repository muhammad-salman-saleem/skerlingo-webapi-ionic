<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Utilisateur extends JsonResource
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
        $tempDate = \Carbon\Carbon::createFromDate((new \Carbon\Carbon($this->created_at))->toDateTimeString());

        $pays = $this->pays;
        $results = parent::toArray($request);
        //return parent::toArray($request);
        return [
            'id' => isset($this->id) ? $this->id : null,
            'enabled' => isset($this->enabled) ? $this->enabled : null,
            'nomComplet' => (isset($this) && $this) ? $this->nom . ' ' . $this->prenom : (isset($results['nom_res']) ? $results['nom_res'] : ''),
            'nom' => (isset($this) && $this && $this->nom) ? $this->nom : (isset($results['nom_res']) ? $results['nom_res'] : ''),
            'prenom' => (isset($this) && $this && $this->prenom) ? $this->prenom : '',
            'email' => (isset($this) && $this) ? $this->email : '',
            'tel' => (isset($this) && $this) ? $this->tel : '',
            'pays_id' => $this->pays_id,
            'ville_id' => $this->ville_id,
            'ville_label' => $this->ville ? $this->ville->label : '',
            'code_retour' => $this->code_retour,
            'password_retour' => $this->password_retour,
            'rib' => $this->rib ? $this->rib : '',
            'cni' => $this->cni ? $this->cni : '',
            'fonction' => $this->fonction ? $this->fonction : '',
            'pays_flag' => ($pays) ? 'https://www.countryflags.io/' . $pays->code . '/flat/64.png' : '',
            'pays_label' => ($pays) ? $pays->label : '',
            'date' => $tempDate->format('d/m/Y H:i'),
            'image' => $this->image ? $this->image : '',
            'image_url' => $this->image ? $this->getImage() : 'https://image.flaticon.com/icons/svg/1738/1738691.svg',
        ];
    }
}
