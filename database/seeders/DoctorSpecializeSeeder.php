<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialtie;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DoctorSpecializeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors     = Doctor::where('active',1)->get();
        $specializes = Specialtie::all();
        foreach($doctors as $doctor){
            for($i=0;$i<2;$i++){
                DB::table('doctor_specializes')->insert([
                    'doctor_id'         => $doctor->id,
                    'specialize_id'     => $specializes->random()->id,
                ]);
            }
        }
    }
}
