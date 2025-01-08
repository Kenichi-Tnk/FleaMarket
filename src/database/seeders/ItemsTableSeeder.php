<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'ノートPC',
            'price' => '45000',
            'description' =>"カラー:グレー\n\n高性能なノートパソコン。 \n傷もありません。 \n\n購入後、即発送いたします。",
            'img_url' => '/storage/img/dummy/Living+Room+Laptop.jpg',
            'user_id' => '1',
            'condition_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => '腕時計',
            'price' => '15000',
            'description' =>"スタイリッシュなデザインのメンズ腕時計。 \n傷もありません。",
            'img_url' => '/storage/img/dummy/Armani+Mens+Clock.jpg',
            'user_id' => '2',
            'condition_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'HDD',
            'price' => '5000',
            'description' =>"カラー:ブラック\n\n高速で信頼性の高いハードディスク。",
            'img_url' => '/storage/img/dummy/HDD+Hard+Disk.jpg',
            'user_id' => '2',
            'condition_id' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => '玉ねぎ３束',
            'price' => '300',
            'description' =>"新鮮な玉ねぎ3束セット。 \n美味しいです。",
            'img_url' => '/storage/img/dummy/iLoveIMG+d.jpg',
            'user_id' => '3',
            'condition_id' => '4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => '革靴',
            'price' => '4000',
            'description' =>"カラー:ブラック\n\nクラシックなデザインの革靴。",
            'img_url' => '/storage/img/dummy/Leather+Shoes+Product+Photo.jpg',
            'user_id' => '4',
            'condition_id' => '5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'マイク',
            'price' => '8000',
            'description' =>"カラー:シルバー\n\n高音質のレコーディング用マイク。",
            'img_url' => '/storage/img/dummy/Music+Mic+4632231.jpg',
            'user_id' => '2',
            'condition_id' => '5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'ショルダーバッグ',
            'price' => '3500',
            'description' =>"カラー:レッド\n\nおしゃれrなショルダーバッグ。",
            'img_url' => '/storage/img/dummy/Purse+fashion+pocket.jpg',
            'user_id' => '3',
            'condition_id' => '4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'タンブラー',
            'price' => '500',
            'description' =>"カラー:ブラック\n\n使いやすいタンブラー。",
            'img_url' => '/storage/img/dummy/Tumbler+souvenir.jpg',
            'user_id' => '4',
            'condition_id' => '5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'コーヒーミル',
            'price' => '4000',
            'description' =>"手動のコーヒーミル。",
            'img_url' => '/storage/img/dummy/Waitress+with+Coffee+Grinder.jpg',
            'user_id' => '6',
            'condition_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::create([
            'name' => 'メイクセット',
            'price' => '2500',
            'description' =>"便利なメイクセット。",
            'img_url' => '/storage/img/dummy/MakeupSet.jpg',
            'user_id' => '7',
            'condition_id' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Item::factory()->count(99)->create();
    }
}
