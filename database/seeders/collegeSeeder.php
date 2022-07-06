<?php


namespace Database\Seeders;
use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class collegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colleges')->delete();
        
        $colleges=[
            [
                'name'=> 'qasion',
                'location' =>'baramka',
               'contiection'=>'123123123',
            ],
            [
                'name'=> 'alhawash',
                'location' =>'baramka',
               'contiection'=>'123123123',
            ]
        ];
         College::insert($colleges);
    }
}
