<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $table = "challenges";

    protected $fillable = [
        'name',  'bank_num','description', 'image','in_date','out_date',
        'amount','amount_paid','charity_id'];

    protected $primaryKey = "id";

    public $timestamps=true ;
    public function charities(){
        return $this->belongsTo( Charity::class,'charity_id');
    }

    public function challs()
    {
        return $this->hasMany(Chall::class,'challenge_id');
    }
}
