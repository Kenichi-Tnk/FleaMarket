<?php

namespace Database\Seeders;

use App\Models\SoldItem;
use Illuminate\Database\Seeder;

class SoldItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SoldItem::factory()->count(30)->create();
    }
}
