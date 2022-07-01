<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory;

    protected $table = "roles";
    protected $fillable = [
        'title',
        'display' ,
        'active',
    ];

    public function permissions()
    {
        return $this->belongsToMany( Permission::class)
        ->select('permission_id','title');
    }
    protected $primaryKey = "id";

    public $timestamps=true ;



    public function check($param)
    {
        $permission = Permission::query()->where('title','=',$param)->first();

        return RolePermission::query()
            ->where('permission_id','=',$permission->id)
            ->where('role_id','=',$this->id)
            ->exists();

    }
}
