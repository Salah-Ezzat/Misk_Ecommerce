<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'القاهرة',
            'الجيزة',
            'الإسكندرية',
            'الدقهلية',
            'البحر الأحمر',
            'البحيرة',
            'الفيوم',
            'الغربية',
            'الشرقية',
            'الإسماعيلية',
            'المنوفية',
            'المنيا',
            'القليوبية',
            'الوادي الجديد',
            'السويس',
            'أسوان',
            'أسيوط',
            'بني سويف',
            'بورسعيد',
            'دمياط',
            'جنوب سيناء',
            'كفر الشيخ',
            'مطروح',
            'الأقصر',
            'قنا',
            'شمال سيناء',
            'سوهاج',
        ];

        foreach ($provinces as $province) {
            DB::table('provinces')->insert([
                'province' => $province,
            ]);
        }
    }
}
