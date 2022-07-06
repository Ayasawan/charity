<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected $table = "beneficiaries";
    protected $fillable = [
        'name',
        'amount' ,
        'date',
        'location',
        'reason_off_benefit',
        'age',
        'charity_id',
    ];
    public function charities(){
        return $this->belongsTo( Charity::class,'charity_id');
    }

    protected $primaryKey = "id";
    public $timestamps=true ;
}
