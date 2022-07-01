<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
         $userRole=Role::all()->where('title','=','user')->first();


// admin user
         $adminUser=new User();

         $adminUser->role_id= $adminRole->id;
         $adminUser->email= 'abee@r.com';
         $adminUser->password=bcrypt('123123');
         $adminUser->first_name='name1';
         $adminUser->last_name= 'name2';

         $adminUser->save();


// user
        $userUser=new User();

        $userUser->role_id= $userRole->id;
        $userUser->email= 'shaz@a.com';
        $userUser->password=bcrypt('1231234');
        $userUser->first_name='name1';
        $userUser->last_name= 'name2';

        $userUser->save();


    }
}
