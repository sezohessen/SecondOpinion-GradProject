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
        $radiology  = Radiology::all();
        $image      = Image::where('base', Radiology::base)->get();
        foreach ($radiology as $rad) {
            $rand = rand(1,3);
            for ($i=0; $i < $rand; $i++) {
                DB::table('radiology_files')->insert([
                    "radiology_id"      => $rad->id,
                    "image_id"          => $image->random()->id,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);
            }

        }
    }
}
