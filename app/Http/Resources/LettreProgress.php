<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LettreProgress extends JsonResource
{

    private static $user_id;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $quizLettre = $this->quizLettre(self::$user_id);
        $pct = number_format($quizLettre ? $quizLettre->pct : 0);

        $color = '#bdc3c7';
        if ($quizLettre) {
            if ($quizLettre->pct < 20) {
                $color = '#c0392b';
            } else if ($quizLettre->pct < 30) {
                $color = '#f1c40f';
            } else if ($quizLettre->pct < 70) {
                $color = '#f39c12';
            } else {
                $color = '#27ae60';
            }
        }

        //return parent::toArray($request);
        $data =  [
            'id' => $this->id,
            'label' => $this->label,
            'romaji' => $this->romaji,
            'color' => $this->color,
            'kana' => $this->kana,
            'pct' => $pct,
            'color' => $color,
            'illustration' => asset('/assets/mobile/' . $this->type . '/' . $this->type . '_' . $this->romaji . '/' . $this->illustration),
            'illustration_letter' => asset('/assets/mobile/' . $this->type . '/' . $this->type . '_' . $this->romaji . '/' . $this->illustration_letter),
        ];
        return $data;
    }



    //I made custom function that returns collection type
    public static function customCollection($resource, $user_id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        //you can add as many params as you want.
        self::$user_id = $user_id;
        return parent::collection($resource);
    }
}
