<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $table = "trainings";

    protected $fillable = [
        'name','about', 'out_date','phone','charity_id' ];

    protected $primaryKey = "id";

    public $timestamps=true ;
}
