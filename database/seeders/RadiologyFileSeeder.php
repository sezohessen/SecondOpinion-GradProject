<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Radiology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RadiologyFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 30 ; $i++)
        {
           DB::table('radiology_files')->insert([
            "radiology_id" =>Radiology::all()->random()->id,
            "image_id" => Image::all()->random()->id,
           'created_at'     => now(),
           'updated_at'     => now(),
           ]);
       }
    }
}
