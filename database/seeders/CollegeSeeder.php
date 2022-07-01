<?php

namespace Database\Seeders;

use App\Models\College;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colleges')->delete();
        // DB::table('colleges')->insert(array(
        //     array(
        //         'name'=> 'al hawash',
        //             'location' =>'baramka',
        //             ' contiectionx'=>'09985479',

        //     ),
        //     array(
        //         'name'=> 'qasuon',
        //         'location' =>'baramka',
        //         ' contiectionx'=>'09965479',

        //     )
        // ));


        $colleges=[
            [
                'name'=> 'al hawash private university',
                'location' =>'baramka',
               'contiection'=>'0998765479',
            ],
            [
                'name'=> 'al hawas private university',
                'location' =>'baramka',
               'contiection'=>'098765479',
            ]
        ];
         College::insert($colleges);
        // foreach ($colleges as $R){
        //     College::create(['name'=>$R,
        //     'location'=>$R,'contiection'=>$R]);
        // }
    }
}
