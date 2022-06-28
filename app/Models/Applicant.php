<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $table = "applicants";

    protected $fillable = [
        'user_id','scolarship_id', 'age','gender','location','phone' ];

    protected $primaryKey = "id";

    public $timestamps=true ;

    
}
