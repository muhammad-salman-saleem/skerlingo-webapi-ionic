<?php

namespace App\Http\Resources;

use App\Http\Resources\Lettre as ResourcesLettre;
use App\Lettre;
use Illuminate\Http\Resources\Json\JsonResource;

class LeconProgress extends JsonResource
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
        $data =  [
            'id' => $this->id,
            'label' => $this->label,
        ];

        $lettres = LettreProgress::customCollection(Lettre::where('lecon_id', $this->id)->get(), self::$user_id);

        $data['lettres'] = $lettres;

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
