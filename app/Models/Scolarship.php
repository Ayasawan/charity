<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scolarship extends Model
{
    use HasFactory;
    protected $table = "scolarships";

    protected $fillable = [
        'max_number','image', 'description','academic_years','charityx_id','college_id' ];

    public function applicants(){
        return $this->hasMany(Applicant::class,'scolarship_id');
    }
    protected $primaryKey = "id";

    public $timestamps=true ;

   
}
