<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;


    protected $table = "permissions_roles";
    protected $fillable = [
        'role_id',
        'permission_id' ,
    ];

    protected $primaryKey = "id";

    public $timestamps=true ;


}
