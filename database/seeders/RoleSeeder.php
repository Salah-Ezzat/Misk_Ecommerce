<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['role' => 'مستخدم عادي'],
            ['role' => 'تاجر جملة'],
            ['role' => 'تاجر جملة الجملة'],
            ['role' => 'أدمن'],
        ]);
    }
}
