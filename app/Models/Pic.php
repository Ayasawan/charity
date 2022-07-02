<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    use HasFactory;

    protected $table = "pics";
    protected $fillable = [
        'name',
        'requ_id',
    ];
    public function requests()
    {
        return $this->belongsTo(Req::class,'requ_id');
    }

    protected $primaryKey = "id";
    public $timestamps=true ;



}
