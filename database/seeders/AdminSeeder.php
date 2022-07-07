<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        
        $admins=[
            [
                'name'=> 'abeer',
                'email' =>'abee@r.com',
               'password'=>bcrypt('123123123'),
            ],
            [
                'name'=> 'shaza',
                'email' =>'shaz@a.com',
               'password'=>bcrypt('123123123'),
            ]
        ];
         Admin::insert($admins);
    }
}
