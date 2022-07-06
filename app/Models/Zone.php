<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = "zones";

    protected $fillable = [
        'name','location', 'phone','available_times','description','charity_id' ];

    public function charities(){
        return $this->belongsTo( Charity::class,'charity_id');
    }
    protected $primaryKey = "id";

    public $timestamps=true ;
}
