<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = "jobs";

    protected $fillable = [
        'name','about', 'out_date','phone','charity_id' ];

    protected $primaryKey = "id";

    public $timestamps=true ;
}
