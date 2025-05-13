<?php

namespace Database\Seeders\Dashboard;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Admin::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $first_role_id = Role::first()->id;
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'phone' => '+201021965455',
            'status' => '1',
            'role_id' => $first_role_id,
        ]);
        Admin::create([
            'name' => 'Alaa',
            'email' => 'alaa@admin.com',
            'password' => bcrypt('password'),
            'phone' => '+201021965456',
            'status' => '1',
            'role_id' => $first_role_id,
        ]);
    }
}
