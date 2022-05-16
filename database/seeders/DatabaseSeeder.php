<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorSpecialize;
use App\Models\Field;
use App\Models\MyMaintenanceList;
use App\Models\NewsDay;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;
use PhpParser\Comment\Doc;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(imagesSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(TermsSeeder::class);
        $this->call(PPolicySeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(LaratrustSeeder::class);
/*         $this->call(CarSeeder::class);
        $this->call(PartSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(UserFavSeeder::class);
        $this->call(SellerFavSeeder::class); */
        /* New */
        $this->call(FieldSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(DoctorSpecializeSeeder::class);
        $this->call(CenterSeeder::class);
        $this->call(RadiologySeeder::class);
        $this->call(RadiologyFileSeeder::class);
        $this->call(ContractSeeder::class);
        $this->call(PaymentSeeder::class);


    }
}
