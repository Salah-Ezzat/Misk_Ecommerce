<?php

namespace Database\Seeders;

use App\Models\Cause;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CauseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cause::insert([
            ['Cause' => 'عدم توفر المنتج وانتهاء الرصيد'],
            ['Cause' => 'اختلاف السعر'],
            ['Cause' => 'وجود مديونيات معلقة'],
            ['Cause' => 'عدم مطابقة طلب الشراء للشروط'],
            ['Cause' => 'أسباب أخرى'],
            ['Cause' => 'غير محدد السبب']
         
        ]);
    }
}
