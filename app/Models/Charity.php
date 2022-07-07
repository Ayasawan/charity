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
   public function images(){
       return $this->hasMany(Image::class,'charity_id');
     }
    public function locations(){
        return $this->hasMany(Location::class,'charity_id');
    }
    public function trainings(){
        return $this->hasMany(Training::class,'charity_id');
    }
    public function jobs(){
        return $this->hasMany(Job::class,'charity_id');
    }
    public function zones(){
        return $this->hasMany(Zone::class,'charity_id');
    }
    public function beneficiaries(){
        return $this->hasMany(Beneficiary::class,'charity_id');
    }
    public function challenges(){
        return $this->hasMany(Challenge::class,'charity_id');
    }
    public function scolarships(){
        return $this->hasMany(Scolarship::class,'charity_id');
    }

    protected $primaryKey = "id";
    public $timestamps=true ;



//   public function images()
//   {
//    return $this->hasMany(Image::class,'charity_id');
//   }

}
