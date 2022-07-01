<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $roles=[
            [
                'title'=> 'admin',
                'display' =>'مشرف',
            ],
            [
                'title'=> 'user',
                'display' =>'مستخدم',
            ]
        ];
         Role::insert($roles);

         $adminRole=Role::all()->where('title','=','admin')->first();
         $userRole=Role::all()->where('title','=','users')->first();


// admin user
         $adminUser=new User();

         $adminUser->role_id= $adminRole->id;
         $adminUser->email= 'abee@r.com';
         $adminUser->password=bcrypt('123123');
         $adminUser->first_name='name1';
         $adminUser->last_name= 'name2';
         $adminUser->save();
// user
        $userrUser=new User();

        $userrUser->role_id= $userRole->id;
        $userrUser->email= 'shaz@a.com';
        $userrUser->password=bcrypt('1231234');
        $userrUser->first_name='name1';
        $userrUser->last_name= 'name2';
        $userrUser->save();


    }
}
