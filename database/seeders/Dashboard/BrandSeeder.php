<?php

namespace Database\Seeders\Dashboard;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Brand::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $brands = [];

        for ($i = 1; $i <= 20; $i++) {
            $brands[] = [
                'name' => [
                    'en' => 'Brand ' . $i,
                    'ar' => 'العلامة التجارية ' . $i,
                ],
                'logo' => 'https://dummyimage.com/150x150/000/fff&text=Brand+' . $i,
            ];
        }

        foreach ($brands as $item) {
            Brand::create($item);
        }
    }
}