<?php

namespace Database\Seeders\Dashboard;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
            Category::create($item);
        }
    }
}
