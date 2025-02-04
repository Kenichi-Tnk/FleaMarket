<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_item')->insert([
            //商品１に「家電」を関連づける
            ['item_id' => 1, 'category_id' => 2],
            //商品２に「ファッション、メンズ、アクセサリー」を関連づける
            ['item_id' => 2, 'category_id' => 2],
            ['item_id' => 2, 'category_id' => 5],
            ['item_id' => 2, 'category_id' => 12],
            //商品３に「家電」を関連づける
            ['item_id' => 3, 'category_id' => 2],
            //商品４に「キッチン」を関連づける
            ['item_id' => 4, 'category_id' => 10],
            //商品５に「ファッション、メンズ」を関連づける
            ['item_id' => 5, 'category_id' => 1],
            ['item_id' => 5, 'category_id' => 5],
            //商品６に「家電」を関連づける
            ['item_id' => 6, 'category_id' => 2],
            //商品７に「ファッション、レディース」を関連づける
            ['item_id' => 7, 'category_id' => 1],
            ['item_id' => 7, 'category_id' => 4],
            //商品８に「キッチン」を関連づける
            ['item_id' => 8, 'category_id' => 10],
            //商品９に「インテリア、キッチン」を関連づける
            ['item_id' => 9, 'category_id' => 3],
            ['item_id' => 9, 'category_id' => 10],
            //商品１０に「レディース、コスメ」を関連づける
            ['item_id' => 10, 'category_id' => 4],
            ['item_id' => 10, 'category_id' => 6],
            //必要に応じて追加
        ]);
    }
}
