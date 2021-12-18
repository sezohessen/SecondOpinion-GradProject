<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $patients        = User::whereHas(
            'role', function($q){
                $q->where('name', User::PatientRole);
            }
        )->get();
        foreach ($patients as $patient){
            DB::table('patients')->insert([
                'national_id'       => $faker->numberBetween(123123,123123123),
                'date_of_birth'     => $faker->date(),
                'user_id'           => $patient->id
            ]);
        }
    }
}
