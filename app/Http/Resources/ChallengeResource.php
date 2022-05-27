<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ChallengeResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            "id"=>$this->id,
            "name"=>$this->name,
            "description"=>$this->description,
            "image"=>$this->image,
            "in_date"=>$this->in_date,
            "out_date"=>$this->out_date,
            "amount"=>$this->amount,
            "amount_paid"=>$this->amount_paid,
            "charity_id"=>$this->charity_id,

        ];
    }
}
