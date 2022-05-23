<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = "locations";
    protected $primaryKey = "id";
    public $timestamps=true ;
    /**
     * @var string[]
     */
    protected $fillable = [
     'govemorate',
        'city' ,
        'street' ,
//        'charity_id',
    ];
}
