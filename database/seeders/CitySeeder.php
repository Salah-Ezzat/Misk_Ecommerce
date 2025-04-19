<?php

namespace Database\Seeders;

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
        $cities = [
            // مراكز محافظة الغربية
            ['city' => 'طنطا', 'province' => 'الغربية'],
            ['city' => 'المحلة الكبرى', 'province' => 'الغربية'],
            ['city' => 'زفتى', 'province' => 'الغربية'],
            ['city' => 'السنطة', 'province' => 'الغربية'],
            ['city' => 'سمنود', 'province' => 'الغربية'],
            ['city' => 'بسيون', 'province' => 'الغربية'],
            ['city' => 'قطور', 'province' => 'الغربية'],
            ['city' => 'كفر الزيات', 'province' => 'الغربية'],

            // مراكز محافظة الدقهلية
            ['city' => 'المنصورة', 'province' => 'الدقهلية'],
            ['city' => 'ميت غمر', 'province' => 'الدقهلية'],
            ['city' => 'طلخا', 'province' => 'الدقهلية'],
            ['city' => 'السنبلاوين', 'province' => 'الدقهلية'],
            ['city' => 'أجا', 'province' => 'الدقهلية'],
            ['city' => 'بلقاس', 'province' => 'الدقهلية'],
            ['city' => 'المنزلة', 'province' => 'الدقهلية'],
            ['city' => 'تمي الأمديد', 'province' => 'الدقهلية'],
            ['city' => 'دكرنس', 'province' => 'الدقهلية'],
            ['city' => 'شربين', 'province' => 'الدقهلية'],
            ['city' => 'بني عبيد', 'province' => 'الدقهلية'],
            ['city' => 'الجمالية', 'province' => 'الدقهلية'],
            ['city' => 'الكردي', 'province' => 'الدقهلية'],
            // محافظة القاهرة
            ['city' => 'مدينة نصر', 'province' => 'القاهرة'],
            ['city' => 'مصر الجديدة', 'province' => 'القاهرة'],
            ['city' => 'المعادي', 'province' => 'القاهرة'],
            ['city' => 'حلوان', 'province' => 'القاهرة'],
            ['city' => 'الزيتون', 'province' => 'القاهرة'],
            ['city' => 'عين شمس', 'province' => 'القاهرة'],
            ['city' => 'المرج', 'province' => 'القاهرة'],
            ['city' => 'الساحل', 'province' => 'القاهرة'],
            ['city' => 'التجمع الخامس', 'province' => 'القاهرة'],
            ['city' => 'البساتين', 'province' => 'القاهرة'],

            // محافظة الشرقية
            ['city' => 'الزقازيق', 'province' => 'الشرقية'],
            ['city' => 'بلبيس', 'province' => 'الشرقية'],
            ['city' => 'العاشر من رمضان', 'province' => 'الشرقية'],
            ['city' => 'ههيا', 'province' => 'الشرقية'],
            ['city' => 'أبو كبير', 'province' => 'الشرقية'],
            ['city' => 'فاقوس', 'province' => 'الشرقية'],
            ['city' => 'أبو حماد', 'province' => 'الشرقية'],
            ['city' => 'منيا القمح', 'province' => 'الشرقية'],
            ['city' => 'الإبراهيمية', 'province' => 'الشرقية'],
            ['city' => 'مشتول السوق', 'province' => 'الشرقية'],
            ['city' => 'ديرب نجم', 'province' => 'الشرقية'],
            ['city' => 'كفر صقر', 'province' => 'الشرقية'],

            // محافظة الإسكندرية
            ['city' => 'سيدي جابر', 'province' => 'الإسكندرية'],
            ['city' => 'محرم بك', 'province' => 'الإسكندرية'],
            ['city' => 'العجمي', 'province' => 'الإسكندرية'],
            ['city' => 'المنتزه', 'province' => 'الإسكندرية'],
            ['city' => 'الجمرك', 'province' => 'الإسكندرية'],
            ['city' => 'المندرة', 'province' => 'الإسكندرية'],
            ['city' => 'العصافرة', 'province' => 'الإسكندرية'],
            ['city' => 'برج العرب', 'province' => 'الإسكندرية'],
        ];
        foreach ($cities as $city) {
            $provinceId = DB::table('provinces')->where('province', $city['province'])->value('id');

            DB::table('cities')->insert([
                'city' => $city['city'],
                'province_id' => $provinceId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
