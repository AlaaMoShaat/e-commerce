<?php

namespace Database\Seeders\Dashboard;

use App\Models\Authorization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Authorization::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permessions = [];
        foreach (__('permessions') as $permession => $value) {
            $permessions[] = $permession;
        }

        Authorization::create([
            'role' => [
                'en' => 'Manager',
                'ar' => 'المدير'
            ],
            'permession' => json_encode($permessions),
        ]);
    }
}