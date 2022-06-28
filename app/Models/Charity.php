<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;
    protected $table = "charities";


    protected $fillable = [
        'name',
        'about' ,
    ];
    protected $primaryKey = "id";

    public $timestamps=true ;

   
}
