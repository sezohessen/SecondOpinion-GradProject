<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          = Faker::create();
        $faker_ar = Faker::create('ar_SA');
        $governorates   = Governorate::all();
        foreach ($governorates as $governorate) {
            for($i = 0;$i<3;$i++){
                DB::table('cities')->insert([
                    'title'             =>  $faker->city,
                    'title_ar'          =>  $faker_ar->city,
                    'governorate_id'    =>  $governorate->id,
                    'created_at'        =>  now(),
                    'updated_at'        =>  now(),
                ]);
            }
        }
    }
}
