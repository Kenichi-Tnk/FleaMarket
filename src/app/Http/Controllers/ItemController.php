<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with('comments.user', 'categories', 'condition')->findOrFail($item_id);
    }

    public function index($item_id)
    {
        $item = $this->loadItemWithRelations($item_id);
        $category = $item->categories->first();

        $categories = [
            'parentCategory' => Category::find($category->parent_id)->name ?? $category->name,
        ];
    }
}
