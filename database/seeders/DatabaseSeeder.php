<?php

namespace Database\Seeders;

use App\Models\Terms;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [FaqSeeder::class],
        );
        User::factory(10)->create();
        /* $this->call(LaratrustSeeder::class); */
        $this->call(CountrySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(TermsSeeder::class);
    }
}
