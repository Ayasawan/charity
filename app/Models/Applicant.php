<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = "applicants";

    protected $fillable = [
       'user_id',
        'scolarship_id', 'age','gender','location','phone' ];

    public function scolarships(){
        return $this->belongsTo( Scolarship::class,'scolarship_id');
    }
    public function users(){
        return $this->belongsTo( User::class,'user_id');
    }
    public function documents()
    {
        return $this->hasMany(Document ::class,'applicant_id');
    }
    public $timestamps=true ;
    protected $primaryKey = "id";

    public $timestamps=true ;

    

}
