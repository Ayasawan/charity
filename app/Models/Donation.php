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

    protected $primaryKey = "id";
}
