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
        $report         = [null,public_path()."/img/DoctorFeedback/test.txt" ];
        for ($i=0; $i < 30 ; $i++){
            $rand           = rand(0,2);
            $docID          = $doctors->random()->id;
            $PatID          = $patients->random()->id;
            $Review         = $faker->boolean;
            $RadID          = DB::table('radiologies')->insertGetId([
                "desc"          => $faker->sentence,
                "reviewed"      => $Review,
                "doctor_id"     => $docID,
                "patient_id"    => $PatID,
                "center_id"     => !$rand ? NULL:$centers->random()->id,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
            /* Doctor Feedback Seeder If Exist Review */
            if($Review){
                DB::table('doctor_feedback')->insert([
                        "doctor_id"         => $docID,
                        "radiology_id"      => $RadID,
                        "patient_id"        => $PatID,
                        "pdf_report"        => $report[$i%2],
                        "desc"              => $faker->sentence,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                ]);
            }
       }
    }
}
