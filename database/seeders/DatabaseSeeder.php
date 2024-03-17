<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
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

        $items = [
            ['position' => 2, 'function' => "天筑精舍簡介",'status' => '1'],
            ['position' => 2, 'function' => "僧伽教育", 'status' => '1',],
            ['position' => 2, 'function' => "居士學佛", 'status' => '1',],
            ['position' => 2, 'function' => "佛門小常識", 'status' => '1',],
            ['position' => 2, 'function' => "課程講義", 'status' => '1',],
            ['position' => 2, 'function' => "法音流佈", 'status' => '1',],
            ['position' => 2, 'function' => "活動紀實", 'status' => '1',],
            ['position' => 2, 'function' => "公告管理", 'status' => '1',],
            ['position' => 2, 'function' => "幻燈片設定", 'status' => '1',],
            ['position' => 2, 'function' => "圖片列印", 'status' => '1',],
            ['position' => 2, 'function' => "用戶管理", 'status' => '1',],
            ['position' => 2, 'function' => "管理員管理", 'status' => '1',],

            ['position' => 3, 'function' => "天筑精舍簡介", 'status' => '1',],
            ['position' => 3, 'function' => "僧伽教育", 'status' => '1',],
            ['position' => 3, 'function' => "居士學佛", 'status' => '1',],
            ['position' => 3, 'function' => "佛門小常識", 'status' => '1',],
            ['position' => 3, 'function' => "課程講義", 'status' => '1',],
            ['position' => 3, 'function' => "法音流佈", 'status' => '1',],
            ['position' => 3, 'function' => "活動紀實", 'status' => '1',],
            ['position' => 3, 'function' => "公告管理", 'status' => '1',],
            ['position' => 3, 'function' => "幻燈片設定", 'status' => '1',],
            ['position' => 3, 'function' => "圖片列印", 'status' => '1',],
            ['position' => 3, 'function' => "用戶管理", 'status' => '1',],
            ['position' => 3, 'function' => "管理員管理", 'status' => '1',],
        ];

        foreach ($items as $item) {
            Permission::create($item);
        }

    }
}
