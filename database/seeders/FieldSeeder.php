<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            DB::table('fields')->insert([
                'name'             => $faker->name,
                'name_ar'          => $faker->name,
            ]);
        }
    }
}
