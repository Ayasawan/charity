<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public static function getPermission($param) {
        return Permission::query()->where('title','=',$param)->first();
    }

    public static function AddPermission($permissionName)
    {
        $permission = Permission::getPermission($permissionName);

        if($permission) return;

        $permission = new Permission();
        $permission->title = $permissionName;

        $permission->save();
    }

//     public function roles()
//     {
//         return $this->belongsToMany( Role::class);
//     }
}
