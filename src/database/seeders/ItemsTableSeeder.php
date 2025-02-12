<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use App\Models\CategoryItem;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'ノートPC',
                'price' => '45000',
                'description' => "カラー:グレー\n\n高性能なノートパソコン。 \n傷もありません。 \n\n購入後、即発送いたします。",
                'img_url' => 'img/dummy/Living+Room+Laptop.jpg',
                'user_id' => '1',
                'condition_id' => '1',
            ],
            [
                'name' => '腕時計',
                'price' => '15000',
                'description' => "スタイリッシュなデザインのメンズ腕時計。 \n傷もありません。",
                'img_url' => 'img/dummy/Armani+Mens+Clock.jpg',
                'user_id' => '2',
                'condition_id' => '1',
            ],
            [
                'name' => 'ショルダーバッグ',
                'price' => '3500',
                'description' => "カラー:レッド\n\nおしゃれなショルダーバッグ。",
                'img_url' => 'img/dummy/Purse+fashion+pocket.jpg',
                'user_id' => '3',
                'condition_id' => '4',
            ],
            [
                'name' => 'タンブラー',
                'price' => '500',
                'description' => "カラー:ブラック\n\n使いやすいタンブラー。",
                'img_url' => 'img/dummy/Tumbler+souvenir.jpg',
                'user_id' => '4',
                'condition_id' => '5',
            ],
            [
                'name' => 'コーヒーミル',
                'price' => '4000',
                'description' => "手動のコーヒーミル。",
                'img_url' => 'img/dummy/Waitress+with+Coffee+Grinder.jpg',
                'user_id' => '6',
                'condition_id' => '1',
            ],
            [
                'name' => 'メイクセット',
                'price' => '2500',
                'description' => "便利なメイクセット。",
                'img_url' => 'img/dummy/MakeupSet.jpg',
                'user_id' => '7',
                'condition_id' => '2',
            ],
        ];

        foreach ($items as $itemData) {
            $item = Item::create(array_merge($itemData, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            // カテゴリを関連付ける
            CategoryItem::create([
                'item_id' => $item->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 追加のアイテムを生成し、カテゴリを関連付ける
        Item::factory()->count(99)->create()->each(function ($item) {
            CategoryItem::create([
                'item_id' => $item->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
