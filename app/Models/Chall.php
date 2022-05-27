<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chall extends Model
{
    use HasFactory;

    protected $table = "challs";

    protected $fillable = [
        'challenge_id','user_id', 'c_amount','c_date'];

    protected $primaryKey = "id";
}
