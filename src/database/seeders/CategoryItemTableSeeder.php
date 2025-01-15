<?php

namespace Database\Seeders;

use App\Models\CategoryItem;
use Illuminate\Database\Seeder;

class CategoryItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryItem::factory()->count(100)->create();
    }
}
