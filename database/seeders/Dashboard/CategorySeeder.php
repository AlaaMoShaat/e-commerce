<?php

namespace Database\Seeders\Dashboard;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => ['en' => 'Elctronics', 'ar' => 'الكترونيات'],
                'status' => 1,
                'parent' => null,
            ],
            [
                'name' => ['en' => 'Category-1', 'ar' => 'التصنيف-1'],
                'status' => 1,
                'parent' => null,
            ],
            [
                'name' => ['en' => 'Category-2', 'ar' => 'النصنيف-2'],
                'status' => 1,
                'parent' => null,
            ],
            [
                'name' => ['en' => 'Category-3', 'ar' => 'التصنيف-3'],
                'status' => 1,
                'parent' => null,
            ],
        ];
        foreach ($data as $item) {
            \App\Models\Category::create($item);
        }
    }
}