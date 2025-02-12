<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();
        return [
            'item_id' => Item::factory(),
            'category_id' => $category->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
