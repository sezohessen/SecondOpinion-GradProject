<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          = Faker::create();
        $centers        = User::whereHas(
            'role', function($q){
                $q->where('name', User::CenterRole);
            }
        )->get();
        $governorates   = Governorate::all();
        $cover          = Image::where('base', Center::Cover)->get();
        foreach ($centers as $center){
            $governorate = $governorates->random();
            DB::table('centers')->insert([
                'desc'              => $faker->text,
                'desc_ar'           => $faker->text,
                'user_id'           => $center->id,
                'cover_id'          => $cover->random()->id,
                'governorate_id'    => $governorate->id,
                'city_id'           => $governorate->cities->random()->id,
                'street'            => $faker->name,
            ]);
        }
    }
}
