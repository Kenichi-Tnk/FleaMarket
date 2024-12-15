<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Category_itemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category_item::factory()->count(100)->create();
    }
}
