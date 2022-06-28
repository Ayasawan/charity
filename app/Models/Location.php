<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = "locations";

    /**
     * @var string[]
     */
    protected $fillable = [
     'govemorate',
        'city' ,
        'street' ,
       'charity_id',
    ];
    protected $primaryKey = "id";
    public $timestamps=true ;

//    public function charities(){
//        return $this->belongsTo( Charity::class,'charity_id');
//    }
//    public function charity()
//    {
//        return $this->belongsTo(Charity::class,'charity_id');
//    }
}
