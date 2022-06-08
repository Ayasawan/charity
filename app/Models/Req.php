<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
    use HasFactory;

    protected $table = "reqs";

    protected $fillable = [
        'user_id','sponsor_id', 'age','gender','location'
        , 'specialization','academic_years','value'
        , 'description','phone','status'];

    protected $primaryKey = "id";

    public $timestamps=true ;
}
