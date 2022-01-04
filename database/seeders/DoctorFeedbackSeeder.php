<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Radiology;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $report=[null,public_path()."/img/DoctorFeedback/test.txt" ];
        for ($i=0; $i < 30 ; $i++)
        {
           DB::table('doctor_feedback')->insert([
                "doctor_id" => Doctor::all()->random()->id,
                "radiology_id"  => Radiology::all()->random()->id,
                "patient_id" => Patient::all()->random()->id,
                "pdf_report" => $report[$i%2],
                "desc"  => $faker->sentence,
                'created_at'     => now(),
                'updated_at'     => now(),
           ]);
       }
    }
}
