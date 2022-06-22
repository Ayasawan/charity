<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    use HasFactory;

    protected $table = "pics";
    protected $fillable = [
        'name',
        'request_id',
    ];
    protected $primaryKey = "id";
    public $timestamps=true ;
}
