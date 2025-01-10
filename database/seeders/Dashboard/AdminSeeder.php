<?php

namespace Database\Seeders\Dashboard;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);
        Admin::create([
            'name' => 'Alaa',
            'email' => 'alaa@admin.com',
            'password' => bcrypt('password'),
            'role_id' => $first_role_id,
        ]);
    }
}
