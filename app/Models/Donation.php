<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;


    protected $table = "donations";

    protected $fillable = [
        'user_id', 'd_amount','d_date'];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public $timestamps=true ;
    protected $primaryKey = "id";
}
