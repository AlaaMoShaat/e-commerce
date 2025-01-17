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
        // DB::table('cities')->truncate();

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

            // United Arab Emirates (Governorate ID 5: Abu Dhabi)
            ['name' => ['en' => 'Al Reem Island', 'ar' => 'جزيرة الريم'], 'governorate_id' => 5],
            ['name' => ['en' => 'Khalifa City', 'ar' => 'مدينة خليفة'], 'governorate_id' => 5],

            // United Arab Emirates (Governorate ID 6: Dubai)
            ['name' => ['en' => 'Deira', 'ar' => 'ديرة'], 'governorate_id' => 6],
            ['name' => ['en' => 'Jumeirah', 'ar' => 'جميرا'], 'governorate_id' => 6],

            // Kuwait (Governorate ID 7: Kuwait City)
            ['name' => ['en' => 'Salmiya', 'ar' => 'السالمية'], 'governorate_id' => 7],
            ['name' => ['en' => 'Hawally', 'ar' => 'حولي'], 'governorate_id' => 7],

            // Qatar (Governorate ID 8: Doha)
            ['name' => ['en' => 'Al Sadd', 'ar' => 'السد'], 'governorate_id' => 8],
            ['name' => ['en' => 'The Pearl', 'ar' => 'اللؤلؤة'], 'governorate_id' => 8],

            // Bahrain (Governorate ID 9: Manama)
            ['name' => ['en' => 'Juffair', 'ar' => 'الجفير'], 'governorate_id' => 9],
            ['name' => ['en' => 'Seef', 'ar' => 'السيف'], 'governorate_id' => 9],

            // Oman (Governorate ID 10: Muscat)
            ['name' => ['en' => 'Muttrah', 'ar' => 'مطرح'], 'governorate_id' => 10],
            ['name' => ['en' => 'Ruwi', 'ar' => 'روي'], 'governorate_id' => 10],

            // Jordan (Governorate ID 11: Amman)
            ['name' => ['en' => 'Jabal Amman', 'ar' => 'جبل عمان'], 'governorate_id' => 11],
            ['name' => ['en' => 'Swefieh', 'ar' => 'الصويفية'], 'governorate_id' => 11],

            // Lebanon (Governorate ID 12: Beirut)
            ['name' => ['en' => 'Hamra', 'ar' => 'الحمرا'], 'governorate_id' => 12],
            ['name' => ['en' => 'Ashrafieh', 'ar' => 'الأشرفية'], 'governorate_id' => 12],

            // Syria (Governorate ID 13: Damascus)
            ['name' => ['en' => 'Mezzeh', 'ar' => 'المزة'], 'governorate_id' => 13],
            ['name' => ['en' => 'Bab Touma', 'ar' => 'باب توما'], 'governorate_id' => 13],

            // Iraq (Governorate ID 14: Baghdad)
            ['name' => ['en' => 'Karrada', 'ar' => 'الكرادة'], 'governorate_id' => 14],
            ['name' => ['en' => 'Adhamiya', 'ar' => 'الأعظمية'], 'governorate_id' => 14],

            // Palestine (Governorate ID 15: Ramallah)
            ['name' => ['en' => 'Al Bireh', 'ar' => 'البيرة'], 'governorate_id' => 15],
            ['name' => ['en' => 'Beituniya', 'ar' => 'بيتونيا'], 'governorate_id' => 15],

            // Yemen (Governorate ID 16: Sanaa)
            ['name' => ['en' => 'Old Sana\'a', 'ar' => 'صنعاء القديمة'], 'governorate_id' => 16],
            ['name' => ['en' => 'Al-Tahrir', 'ar' => 'التحرير'], 'governorate_id' => 16],

            // Algeria (Governorate ID 17: Algiers)
            ['name' => ['en' => 'Bab El Oued', 'ar' => 'باب الواد'], 'governorate_id' => 17],
            ['name' => ['en' => 'Hydra', 'ar' => 'حيدرة'], 'governorate_id' => 17],

            // Morocco (Governorate ID 18: Rabat)
            ['name' => ['en' => 'Agdal', 'ar' => 'أكدال'], 'governorate_id' => 18],
            ['name' => ['en' => 'Souissi', 'ar' => 'السويسي'], 'governorate_id' => 18],

            // Tunisia (Governorate ID 19: Tunis)
            ['name' => ['en' => 'La Marsa', 'ar' => 'المرسى'], 'governorate_id' => 19],
            ['name' => ['en' => 'Sidi Bou Said', 'ar' => 'سيدي بوسعيد'], 'governorate_id' => 19],

            // Sudan (Governorate ID 20: Khartoum)
            ['name' => ['en' => 'Bahri', 'ar' => 'بحري'], 'governorate_id' => 20],
            ['name' => ['en' => 'Omdurman', 'ar' => 'أم درمان'], 'governorate_id' => 20],

            // Somalia (Governorate ID 21: Mogadishu)
            ['name' => ['en' => 'Waberi', 'ar' => 'وابري'], 'governorate_id' => 21],
            ['name' => ['en' => 'Hodan', 'ar' => 'هودان'], 'governorate_id' => 21],

            // Mauritania (Governorate ID 22: Nouakchott)
            ['name' => ['en' => 'Tevragh Zeina', 'ar' => 'تفرغ زينة'], 'governorate_id' => 22],
            ['name' => ['en' => 'El Mina', 'ar' => 'الميناء'], 'governorate_id' => 22],

            // Djibouti (Governorate ID 23: Djibouti)
            ['name' => ['en' => 'Djibouti City', 'ar' => 'مدينة جيبوتي'], 'governorate_id' => 23],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}