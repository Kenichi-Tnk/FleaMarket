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
            ['item_id' => 1, 'category_id' => 1],
            ['item_id' => 2, 'category_id' => 2],
            //必要に応じて追加
        ]);
    }
}
