<?php

namespace Database\Seeders\Dashboard;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $cities = [
            // Egypt (Governorate ID 1: Alexandria)
            ['name' => ['en' => 'Alexandria', 'ar' => 'الإسكندرية'], 'governorate_id' => 1],
            ['name' => ['en' => 'Borg El Arab', 'ar' => 'برج العرب'], 'governorate_id' => 1],

            // Egypt (Governorate ID 2: Cairo)
            ['name' => ['en' => 'Nasr City', 'ar' => 'مدينة نصر'], 'governorate_id' => 2],
            ['name' => ['en' => 'Maadi', 'ar' => 'المعادي'], 'governorate_id' => 2],
            ['name' => ['en' => 'Heliopolis', 'ar' => 'مصر الجديدة'], 'governorate_id' => 2],

            // Saudi Arabia (Governorate ID 3: Riyadh)
            ['name' => ['en' => 'Al-Olaya', 'ar' => 'العليا'], 'governorate_id' => 3],
            ['name' => ['en' => 'Al-Malaz', 'ar' => 'الملز'], 'governorate_id' => 3],

            // Saudi Arabia (Governorate ID 4: Mecca)
            ['name' => ['en' => 'Al Aziziyah', 'ar' => 'العزيزية'], 'governorate_id' => 4],
            ['name' => ['en' => 'Al Sharaie', 'ar' => 'الشرائع'], 'governorate_id' => 4],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}