<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contentinfo extends Model
{
    use HasFactory;
    protected $table = "contentinfos";


    protected $fillable = [
      'departe',
        'phone' ,
        'charity_id',
    ];
    protected $primaryKey = "id";

    public $timestamps=true ;
}
