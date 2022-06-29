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
        , 'specialize','academic_years','value'
        , 'description','phone','status'];

    protected $primaryKey = "id";

    public $timestamps=true ;


    public function sponsors(){
        return $this->belongsTo( Sponsor::class,'sponsor_id');
    }

    public function users(){
        return $this->belongsTo( User::class,'user_id');
    }


    public function pics()
    {
        return $this->hasMany(Pic::class,'request_id');
    }
}
