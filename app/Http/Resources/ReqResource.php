<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ReqResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            "id"=>$this->id,
            "user_id"=>$this->user_id,
            "sponsor_id"=>$this->sponsor_id,
            "age"=>$this->age,
            "gender"=>$this->gender,
            "location"=>$this->location,
            "specialize"=>$this->specializ,
            "academic_years"=>$this->academic_years,
            "value"=>$this->value,
            "description"=>$this->description,
            "phone"=>$this->phone,
            "status"=>$this->status,

        ];
    }
}
