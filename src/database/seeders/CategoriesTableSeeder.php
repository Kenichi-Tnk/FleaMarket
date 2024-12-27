<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'content' => 'ファッション',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => '家電',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'インテリア',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'レディース',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'メンズ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'コスメ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => '本',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'ゲーム',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'スポーツ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'キッチン',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'ハンドメイド',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'アクセサリー',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'おもちゃ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Category::create([
            'content' => 'ベビー・キッズ',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
