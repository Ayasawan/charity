<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scolarship extends Model
{
    use HasFactory;
    protected $table = "scolarships";

    protected $fillable = [
        'max_number','image', 'description','academic_years','charity_id','college_id' ];

    public function applicants(){
        return $this->hasMany(Applicant::class,'scolarship_id');
    }
    public function charities(){
        return $this->belongsTo( Charity::class,'charity_id');
    }
    protected $primaryKey = "id";

    public $timestamps=true ;


}
