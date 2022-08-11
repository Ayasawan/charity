<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "user_id"=>$this->user_id,
            "scolarship_id"=>$this->scolarship_id,
            "age"=>$this->age,
            "gender"=>$this->gender,
            "location"=>$this->location,
            "phone"=>$this->phone,
            "documents of applicants"=>$this->documents()->get(),
        ];
    }
}
