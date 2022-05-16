<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker      = Faker::create();
        $patients   = Patient::all();
        $doctors    = Doctor::all();
        $centers    = Center::all();
        for($i = 0; $i<20;$i++){
            DB::table('payments')->insert([
                'doctor_id'         => $doctors->random()->id,
                'patient_id'        => $patients->random()->id,
                'center_id'         => $centers->random()->id,
                'price'             => $faker->numberBetween(40,500),
                'status'            => Payment::Success
            ]);
        }
    }
}
