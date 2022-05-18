<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 30 ; $i++){
            DB::table('reviews')->insert([
                'rating'     =>  $faker->randomNumber(1) % 5,
                'comment'     => $faker->sentence,
                'patient_id' => Patient::all()->random()->id,
                'doctor_id'=> Doctor::all()->random()->id,
                'created_at'        =>  now(),
                'updated_at'        =>  now(),
            ]);
        }
    }
}
