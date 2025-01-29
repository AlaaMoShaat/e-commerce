<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Dashboard\CitySeeder;
use Database\Seeders\Dashboard\RoleSeeder;
use Database\Seeders\Dashboard\AdminSeeder;
use Database\Seeders\Dashboard\BrandSeeder;
use Database\Seeders\Dashboard\CouponSeeder;
use Database\Seeders\Dashboard\CountrySeeder;
use Database\Seeders\Dashboard\CategorySeeder;
use Database\Seeders\Dashboard\GovernorateSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            CouponSeeder::class
            // Your other seeders here...
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}