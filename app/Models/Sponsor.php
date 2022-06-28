<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $table = "sponsors";

    protected $fillable = [
        'submission_date', ];

    protected $primaryKey = "id";

    public $timestamps=true ;



    public function requests()
    {
        return $this->hasMany(Req::class,'sponsor_id');
    }

}
