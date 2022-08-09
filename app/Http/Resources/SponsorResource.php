<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class SponsorResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
