<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $table = "challenges";

    protected $fillable = [
        'name','description', 'image','in_date','out_date',
        'amount','amount_paid','charity_id'];

    protected $primaryKey = "id";

    public $timestamps=true ;
}
