<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors    = Doctor::all();
        $centers    = Center::all();
        foreach ($doctors as $doctor){
            DB::table('contracts')->insert([
                'doctor_id'     => $doctor->id,
                'center_id'     => $centers->random()->id
            ]);
        }
    }
}
