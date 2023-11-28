<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         #測試管理員帳號
         \App\Models\User::factory()->create([
             'account' => 'admin',
             'name' => 'fj494',
             'email' => 'admin@gmail.com',
             'password' => 'admin123',
             'sex' => '男',
             'birthday' => '2023/11/27',
             'phone' => '0987654321',
             'address' => 'Taiwan',
         ]);
//         \App\Models\Admin::factory()->create([
//             ''
//         ])
    }
}
