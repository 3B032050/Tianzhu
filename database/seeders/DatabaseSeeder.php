<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Web_content;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Web_hierarchy;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        #測試管理員帳號
        User::factory()->create([
            'account' => 'admin',
            'name' => 'fj494',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'sex' => '男',
            'birthday' => '2023/11/27',
            'phone' => '0987654321',
            'address' => 'Taiwan',
            'classification' => '',
        ])->each(function ($user) {
            // 創建相對應的管理員資料
            Admin::create([
                'user_id' => $user->id,
                'position' => 1, // 預設管理員的等級為1
            ]);
        });

        User::factory(10)->create();

        Web_hierarchy::factory()->create([
            'web_id' => '0',
            'parent_id' => 'none',
            'title' => '首頁',
        ]);
        Web_content::create([
            'web_id' => '0',
            'content' => '輸入內容..',
        ]);
    }
}
