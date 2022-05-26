<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ChallResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            "id"=>$this->id,
            "challenge_id"=>$this->challenge_id,
            "user_id"=>$this->user_id,
            "c_amount"=>$this->c_amount,
            "c_date"=>$this->c_date,

        ];
    }
}
