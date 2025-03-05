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

            // Saudi Arabia
            ['id' => $id++,'name' => ['en' => 'Riyadh', 'ar' => 'الرياض'], 'country_id' => 2],
            ['id' => $id++,'name' => ['en' => 'Mecca', 'ar' => 'مكة المكرمة'], 'country_id' => 2],
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
