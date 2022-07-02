<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = "images";
    protected $fillable = [
        'img_url',
        'charity_id',
    ];
    protected $primaryKey = "id";
    public $timestamps=true ;

    public function charities(){
        return $this->belongsTo( Charity::class,'charity_id');
    }
}
