<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Field;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $doctors        = User::whereHas(
            'role', function($q){
                $q->where('name', User::DoctorRole);
            }
        )->get();
        $avatar     = Image::where('base', Doctor::Avatar)->get();
        $field  = Field::all();
        foreach ($doctors as $doctor){
            DB::table('doctors')->insert([
                'national_id'       => $faker->numberBetween(123123,123123123),
                'facebook'          => $faker->url,
                'brief_desc'        => $faker->text,
                'brief_desc_ar'     => $faker->text,
                'active'            => 1,
                'field_id'          => $field->random()->id,
                'avatar_id'         => $avatar->random()->id,
                'user_id'           => $doctor->id,
            ]);
        }
    }
}
