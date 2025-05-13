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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        City::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $cities = array(
            array('name' => array('en' => 'Jerusalem', 'ar' => 'القدس')),
            array('name' => array('en' => 'Bethlehem', 'ar' => 'بيت لحم')),
            array('name' => array('en' => 'Jenin', 'ar' => 'جنين')),
            array('name' => array('en' => 'Tulkarm', 'ar' => 'طولكرم')),
            array('name' => array('en' => 'Qalqilya', 'ar' => 'قلقيلية')),
            array('name' => array('en' => 'Salfit', 'ar' => 'سلفيت')),
            array('name' => array('en' => 'Nablus', 'ar' => 'نابلس')),
            array('name' => array('en' => 'Tubas', 'ar' => 'طوباس')),
            array('name' => array('en' => 'Jericho', 'ar' => 'أريحا')),
            array('name' => array('en' => 'Ramallah and Al-Bireh', 'ar' => 'رام الله والبيرة')),
            array('name' => array('en' => 'Hebron', 'ar' => 'الخليل')),
            array('name' => array('en' => 'North Gaza', 'ar' => 'شمال غزة')),
            array('name' => array('en' => 'Gaza', 'ar' => 'غزة')),
            array('name' => array('en' => 'Deir al-Balah', 'ar' => 'دير البلح')),
            array('name' => array('en' => 'Khan Yunis', 'ar' => 'خان يونس')),
            array('name' => array('en' => 'Rafah', 'ar' => 'رفح')),
        );

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}