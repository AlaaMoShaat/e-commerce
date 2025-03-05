<?php

namespace Database\Seeders\Dashboard;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Country::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $countries = array(
            array(
                'name' => array('en' => 'Egypt', 'ar' => 'مصر'),
                'iso_code' => 'EG',
                'phone_code' => '20',
            ),
            array(
                'name' => array('en' => 'Saudi Arabia', 'ar' => 'المملكة العربية السعودية'),
                'iso_code' => 'SA',
                'phone_code' => '966',
            ),
        );


        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}