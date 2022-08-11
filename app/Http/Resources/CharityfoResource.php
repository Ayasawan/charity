<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharityfoResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "about"=>$this->about,
            "images of charity"=>$this->images()->get(),
        ];
    }
}
