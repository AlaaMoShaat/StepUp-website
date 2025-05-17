<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Offer::create([
            'brochure_id' => 1,
            'category_id' => 1,
            'title' => [
                'en' => 'Winter Sale Jacket',
                'ar' => 'عرض جاكيت الشتاء'
            ],
            'description' => [
                'en' => 'High-quality winter jacket at a discounted price.',
                'ar' => 'جاكيت شتوي عالي الجودة بسعر مخفض.'
            ],
            'price' => 80.00,
            'discount_price' => 60.00,
            'available_for' => now()->addDays(10),
            'available_in_stock' => true,
            'status' => true,
        ]);
    }
}
