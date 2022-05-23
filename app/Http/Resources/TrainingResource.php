<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class TrainingResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            "id"=>$this->id,
            "name"=>$this->name,
            "about"=>$this->about,
            "out_date"=>$this->date,
            "phone"=>$this->phone,
            "charity_id"=>$this->charity_id,

        ];
    }
}
