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
        $faker          = Faker::create();
        $doctors        = Doctor::all();
        $patients       = Patient::all();
        $centers        = Center::all();

        for ($i=0; $i < 30 ; $i++){
            $rand           = rand(0,2);
            DB::table('radiologies')->insert([
                "desc"          => $faker->sentence,
                "reviewed"       => $faker->boolean,
                "doctor_id"     => $doctors->random()->id,
                "patient_id"    => $patients->random()->id,
                "center_id"     => !$rand ? NULL:$centers->random()->id,
                'created_at'    => now(),
                'updated_at'    => now(),
           ]);
       }
    }
}
