<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ChallengeResource extends JsonResource
{

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
