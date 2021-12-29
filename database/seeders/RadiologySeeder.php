<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class RadiologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker        = Faker::create();
        for ($i=0; $i < 30 ; $i++)
        {
           DB::table('radiologies')->insert([
            "desc" => $faker->sentence,
            "doctor_id" => Doctor::all()->random()->id,
            "patient_id"  => Patient::all()->random()->id,
            "center_id" => Center::all()->random()->id,
           'created_at'     => now(),
           'updated_at'     => now(),
           ]);
       }
    }
}
