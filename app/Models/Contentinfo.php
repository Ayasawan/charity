<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contentinfo extends Model
{
    use HasFactory;
    protected $table = "contentinfos";


    protected $fillable = [
        'department',
        'contact' ,
        'charity_id',
    ];
    public function charities(){
        return $this->belongsTo( Charity::class,'charity_id');
    }
    protected $primaryKey = "id";

    public $timestamps=true ;
}
