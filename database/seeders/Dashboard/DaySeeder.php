<?php

namespace Database\Seeders\Dashboard;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('days')->truncate();

        $days = [
            ['en' => 'Saturday',   'ar' => 'السبت'],
            ['en' => 'Sunday',     'ar' => 'الأحد'],
            ['en' => 'Monday',     'ar' => 'الإثنين'],
            ['en' => 'Tuesday',    'ar' => 'الثلاثاء'],
            ['en' => 'Wednesday',  'ar' => 'الأربعاء'],
            ['en' => 'Thursday',   'ar' => 'الخميس'],
            ['en' => 'Friday',     'ar' => 'الجمعة'],
        ];

        foreach ($days as $day) {
            DB::table('days')->insert([
                'day' => json_encode($day),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
