<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateLaratrustTables();

        $config = Config::get('laratrust_seeder.roles_structure');

        if ($config === null) {
            $this->command->error("The configuration has not been published. Did you run `php artisan vendor:publish --tag=\"laratrust-seeder\"`");
            $this->command->line('');
            return false;
        }

        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Models\Role::firstOrCreate([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Models\Permission::firstOrCreate([
                        'name' => $module . '-' . $permissionValue,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            if (Config::get('laratrust_seeder.create_users')) {
                $this->command->info("Creating '{$key}' user");
                // Create default user for each role
                $user = \App\Models\User::create([
                    'image_id' => \App\Models\Image::all()->random()->id,
                    'interest_country' => \App\Models\Country::all()->random()->id,
                    'first_name' => ucwords(str_replace('_', ' ', $key)),
                    'last_name' => ucwords(str_replace('_', ' ', $key)),
                    'country_code' => \App\Models\Country::all()->random()->code,
                    'country_phone' => \App\Models\Country::all()->random()->country_phone,
                    'whats_app' => \App\Models\Country::all()->random()->country_phone . rand(1000000, 10000000),
                    'email' => $key.'@app.com',
                    'email_verified_at' => now(),
                    'is_phone_virefied' => 1,
                    'phone' => rand(1000000, 10000000),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10)
                ]);
                $user->attachRole($role);
            }


        }
        for ($i = 0; $i < 20; $i++) {
            $countyr = \App\Models\Country::all()->random();
            $user = \App\Models\User::create([
                    'image_id' => \App\Models\Image::all()->random()->id,
                    'interest_country' => $countyr->id,
                    'first_name' => ucwords(str_replace('_', ' ', 'agency')).$i,
                    'last_name' => ucwords(str_replace('_', ' ', 'agency')).$i,
                    'country_code' => $countyr->code,
                    'country_phone' => $countyr->country_phone,
                    'whats_app' => $countyr->country_phone . rand(1000000, 10000000),
                    'email' => 'agency'.$i.'@app.com',
                    'email_verified_at' => now(),
                    'is_phone_virefied' => 1,
                    'phone' => rand(1000000, 10000000).$i,
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token' => Str::random(10)
                ]);
                $user->attachRole('agency');
        }
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return  void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();

        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();

        if (Config::get('laratrust_seeder.truncate_tables')) {
            DB::table('roles')->truncate();
            DB::table('permissions')->truncate();

            if (Config::get('laratrust_seeder.create_users')) {
                $usersTable = (new \App\Models\User)->getTable();
                DB::table($usersTable)->truncate();
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
