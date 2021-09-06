<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker      = Faker::create();
        $cars       = Car::all();
        $users      = User::all();
        $image      = Image::where('base', '/img/PartImgs/')->get();
        for ($i=0; $i < 30 ; $i++) {
            $partID  = DB::table('parts')->insertGetId([
                'name'          => $faker->name,
                'desc'          => $faker->text,
                'part_number'   => $faker->numberBetween(100000,9999999),
                'price'         => $faker->numberBetween(100,10000),
                'in_stock'      => $faker->numberBetween(0,10),
                'active'        => $faker->boolean,
                'views'         => $faker->numberBetween(0,1000),
                'car_id'        => $cars->random()->id,
                'user_id'       => $users->random()->id,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
            $loop   = rand(1,4);
            for ($j=0; $j < $loop ; $j++) {
                DB::table('part_imgs')->insert([
                    'part_id'       => $partID,
                    'img_id'        => $image->random()->id,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]);
            }
        }
    }
}
