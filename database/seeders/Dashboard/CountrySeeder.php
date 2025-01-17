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
        // DB::table('countries')->truncate();

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
            array(
                'name' => array('en' => 'United Arab Emirates', 'ar' => 'الإمارات العربية المتحدة'),
                'iso_code' => 'AE',
                'phone_code' => '971',
            ),
            array(
                'name' => array('en' => 'Kuwait', 'ar' => 'الكويت'),
                'iso_code' => 'KW',
                'phone_code' => '965',
            ),
            array(
                'name' => array('en' => 'Qatar', 'ar' => 'قطر'),
                'iso_code' => 'QA',
                'phone_code' => '974',
            ),
            array(
                'name' => array('en' => 'Bahrain', 'ar' => 'البحرين'),
                'iso_code' => 'BH',
                'phone_code' => '973',
            ),
            array(
                'name' => array('en' => 'Oman', 'ar' => 'عمان'),
                'iso_code' => 'OM',
                'phone_code' => '968',
            ),
            array(
                'name' => array('en' => 'Jordan', 'ar' => 'الأردن'),
                'iso_code' => 'JO',
                'phone_code' => '962',
            ),
            array(
                'name' => array('en' => 'Lebanon', 'ar' => 'لبنان'),
                'iso_code' => 'LB',
                'phone_code' => '961',
            ),
            array(
                'name' => array('en' => 'Syria', 'ar' => 'سوريا'),
                'iso_code' => 'SY',
                'phone_code' => '963',
            ),
            array(
                'name' => array('en' => 'Iraq', 'ar' => 'العراق'),
                'iso_code' => 'IQ',
                'phone_code' => '964',
            ),
            array(
                'name' => array('en' => 'Palestine', 'ar' => 'فلسطين'),
                'iso_code' => 'PS',
                'phone_code' => '970',
            ),
            array(
                'name' => array('en' => 'Yemen', 'ar' => 'اليمن'),
                'iso_code' => 'YE',
                'phone_code' => '967',
            ),
            array(
                'name' => array('en' => 'Sudan', 'ar' => 'السودان'),
                'iso_code' => 'SD',
                'phone_code' => '249',
            ),
            array(
                'name' => array('en' => 'Libya', 'ar' => 'ليبيا'),
                'iso_code' => 'LY',
                'phone_code' => '218',
            ),
            array(
                'name' => array('en' => 'Algeria', 'ar' => 'الجزائر'),
                'iso_code' => 'DZ',
                'phone_code' => '213',
            ),
            array(
                'name' => array('en' => 'Morocco', 'ar' => 'المغرب'),
                'iso_code' => 'MA',
                'phone_code' => '212',
            ),
            array(
                'name' => array('en' => 'Tunisia', 'ar' => 'تونس'),
                'iso_code' => 'TN',
                'phone_code' => '216',
            ),
            array(
                'name' => array('en' => 'Mauritania', 'ar' => 'موريتانيا'),
                'iso_code' => 'MR',
                'phone_code' => '222',
            ),
            array(
                'name' => array('en' => 'Somalia', 'ar' => 'الصومال'),
                'iso_code' => 'SO',
                'phone_code' => '252',
            ),
            array(
                'name' => array('en' => 'Djibouti', 'ar' => 'جيبوتي'),
                'iso_code' => 'DJ',
                'phone_code' => '253',
            ),
            array(
                'name' => array('en' => 'Comoros', 'ar' => 'جزر القمر'),
                'iso_code' => 'KM',
                'phone_code' => '269',
            ),
        );


        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}