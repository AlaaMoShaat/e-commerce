<?php

namespace Database\Seeders\Dashboard;

use App\Models\Governorate;
use App\Models\ShippingGovernorate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Governorate::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $id = 1;
        $governorates = [
            // Egypt
            ['id' => $id++,'name' => ['en' => 'Alexandria', 'ar' => 'الإسكندرية'], 'country_id' => 1],
            ['id' => $id++,'name' => ['en' => 'Cairo', 'ar' => 'القاهرة'], 'country_id' => 1],
            ['id' => $id++,'name' => ['en' => 'Giza', 'ar' => 'الجيزة'], 'country_id' => 1],
            ['id' => $id++,'name' => ['en' => 'Aswan', 'ar' => 'أسوان'], 'country_id' => 1],
            ['id' => $id++,'name' => ['en' => 'Luxor', 'ar' => 'الأقصر'], 'country_id' => 1],
            ['id' => $id++,'name' => ['en' => 'Ismailia', 'ar' => 'الإسماعيلية'], 'country_id' => 1],
            ['id' => $id++,'name' => ['en' => 'Port Said', 'ar' => 'بورسعيد'], 'country_id' => 1],

            // Saudi Arabia
            ['id' => $id++,'name' => ['en' => 'Riyadh', 'ar' => 'الرياض'], 'country_id' => 2],
            ['id' => $id++,'name' => ['en' => 'Mecca', 'ar' => 'مكة المكرمة'], 'country_id' => 2],
            ['id' => $id++,'name' => ['en' => 'Medina', 'ar' => 'المدينة المنورة'], 'country_id' => 2],
            ['id' => $id++,'name' => ['en' => 'Dammam', 'ar' => 'الدمام'], 'country_id' => 2],
            ['id' => $id++,'name' => ['en' => 'Jeddah', 'ar' => 'جدة'], 'country_id' => 2],
            ['id' => $id++,'name' => ['en' => 'Abha', 'ar' => 'أبها'], 'country_id' => 2],

            // United Arab Emirates
            ['id' => $id++,'name' => ['en' => 'Abu Dhabi', 'ar' => 'أبو ظبي'], 'country_id' => 3],
            ['id' => $id++,'name' => ['en' => 'Dubai', 'ar' => 'دبي'], 'country_id' => 3],
            ['id' => $id++,'name' => ['en' => 'Sharjah', 'ar' => 'الشارقة'], 'country_id' => 3],
            ['id' => $id++,'name' => ['en' => 'Ajman', 'ar' => 'عجمان'], 'country_id' => 3],
            ['id' => $id++,'name' => ['en' => 'Fujairah', 'ar' => 'الفجيرة'], 'country_id' => 3],
            ['id' => $id++,'name' => ['en' => 'Ras Al Khaimah', 'ar' => 'رأس الخيمة'], 'country_id' => 3],

            // Kuwait
            ['id' => $id++,'name' => ['en' => 'Kuwait City', 'ar' => 'مدينة الكويت'], 'country_id' => 4],
            ['id' => $id++,'name' => ['en' => 'Hawally', 'ar' => 'حولي'], 'country_id' => 4],
            ['id' => $id++,'name' => ['en' => 'Farwaniya', 'ar' => 'الفروانية'], 'country_id' => 4],
            ['id' => $id++,'name' => ['en' => 'Ahmadi', 'ar' => 'الأحمدي'], 'country_id' => 4],

            // Qatar
            ['id' => $id++,'name' => ['en' => 'Doha', 'ar' => 'الدوحة'], 'country_id' => 5],
            ['id' => $id++,'name' => ['en' => 'Al Rayyan', 'ar' => 'الريان'], 'country_id' => 5],
            ['id' => $id++,'name' => ['en' => 'Al Wakrah', 'ar' => 'الوكرة'], 'country_id' => 5],

            // Bahrain
            ['id' => $id++,'name' => ['en' => 'Manama', 'ar' => 'المنامة'], 'country_id' => 6],
            ['id' => $id++,'name' => ['en' => 'Muharraq', 'ar' => 'المحرق'], 'country_id' => 6],
            ['id' => $id++,'name' => ['en' => 'Riffa', 'ar' => 'الرفاع'], 'country_id' => 6],

            // Oman
            ['id' => $id++,'name' => ['en' => 'Muscat', 'ar' => 'مسقط'], 'country_id' => 7],
            ['id' => $id++,'name' => ['en' => 'Salalah', 'ar' => 'صلالة'], 'country_id' => 7],

            // Jordan
            ['id' => $id++,'name' => ['en' => 'Amman', 'ar' => 'عمان'], 'country_id' => 8],
            ['id' => $id++,'name' => ['en' => 'Irbid', 'ar' => 'إربد'], 'country_id' => 8],
            ['id' => $id++,'name' => ['en' => 'Aqaba', 'ar' => 'العقبة'], 'country_id' => 8],

            // Lebanon
            ['id' => $id++,'name' => ['en' => 'Beirut', 'ar' => 'بيروت'], 'country_id' => 9],
            ['id' => $id++,'name' => ['en' => 'Tripoli', 'ar' => 'طرابلس'], 'country_id' => 9],

            // Syria
            ['id' => $id++,'name' => ['en' => 'Damascus', 'ar' => 'دمشق'], 'country_id' => 10],
            ['id' => $id++,'name' => ['en' => 'Aleppo', 'ar' => 'حلب'], 'country_id' => 10],

            // Iraq
            ['id' => $id++,'name' => ['en' => 'Baghdad', 'ar' => 'بغداد'], 'country_id' => 11],
            ['id' => $id++,'name' => ['en' => 'Basra', 'ar' => 'البصرة'], 'country_id' => 11],
            ['id' => $id++,'name' => ['en' => 'Mosul', 'ar' => 'الموصل'], 'country_id' => 11],

            // Palestine
            ['id' => $id++,'name' => ['en' => 'Ramallah', 'ar' => 'رام الله'], 'country_id' => 12],
            ['id' => $id++,'name' => ['en' => 'Gaza', 'ar' => 'غزة'], 'country_id' => 12],

            // Yemen
            ['id' => $id++,'name' => ['en' => 'Sanaa', 'ar' => 'صنعاء'], 'country_id' => 13],
            ['id' => $id++,'name' => ['en' => 'Aden', 'ar' => 'عدن'], 'country_id' => 13],

            // Sudan
            ['id' => $id++,'name' => ['en' => 'Khartoum', 'ar' => 'الخرطوم'], 'country_id' => 14],
            ['id' => $id++,'name' => ['en' => 'Omdurman', 'ar' => 'أم درمان'], 'country_id' => 14],

            // Algeria
            ['id' => $id++,'name' => ['en' => 'Algiers', 'ar' => 'الجزائر'], 'country_id' => 16],

            // Morocco
            ['id' => $id++,'name' => ['en' => 'Rabat', 'ar' => 'الرباط'], 'country_id' => 17],
            ['id' => $id++,'name' => ['en' => 'Casablanca', 'ar' => 'الدار البيضاء'], 'country_id' => 17],

            // Tunisia
            ['id' => $id++,'name' => ['en' => 'Tunis', 'ar' => 'تونس'], 'country_id' => 18],

            // Somalia
            ['id' => $id++,'name' => ['en' => 'Mogadishu', 'ar' => 'مقديشو'], 'country_id' => 20],

            // Mauritania
            ['id' => $id++,'name' => ['en' => 'Nouakchott', 'ar' => 'نواكشوط'], 'country_id' => 19],

            // Djibouti
            ['id' => $id++,'name' => ['en' => 'Djibouti', 'ar' => 'جيبوتي'], 'country_id' => 21],

            // Comoros
            ['id' => $id++,'name' => ['en' => 'Moroni', 'ar' => 'موروني'], 'country_id' => 22],
        ];

        foreach ($governorates as $governor) {
            Governorate::create($governor);

            ShippingGovernorate::create([
                'governorate_id' => $governor['id'],
                'price' => 100,
            ]);
        }
    }
}