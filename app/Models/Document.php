<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = "documents";
    protected $fillable = [
        'name',
        'applicant_id',
    ];
    public function applicants(){
        return $this->belongsTo( Applicant::class,'applicant_id');
    }
    protected $primaryKey = "id";
    public $timestamps=true ;
}
