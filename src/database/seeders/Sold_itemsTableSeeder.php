<?php

namespace Database\Seeders;

use App\Models\Sold_item;
use Illuminate\Database\Seeder;

class Sold_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sold_item::factory()->count(30)->create();
    }
}
