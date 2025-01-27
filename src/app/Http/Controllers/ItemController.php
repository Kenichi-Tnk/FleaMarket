<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with( 'categories', 'condition', 'favoriteUsers')->findOrFail($item_id);
    }

    public function index($item_id)
    {
        $item = $this->loadItemWithRelations($item_id);
        $category = $item->categories->first();

        return view('item_detail', [
            'item' => $item,
            'favoritesCount' => $item->favoriteUsers->count(),
            'commentsCount' => $item->comments->count(),
            'condition' => $item->condition->condition,
            'userFavorited' => $item->favoriteUsers()->where('user_id', Auth::id())->exists(),
            'userItem' => $item->user_id == Auth::id(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:1',
            'condition_id' => 'required|integer',
            'category_ids' => 'required|array',
            'category_ids.*' => 'integer|exists:categories,id',
            'img_url' => 'nullable|image|max:2048',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->condition_id = $request->condition_id;
        $item->user_id = Auth::id();

        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('public/img/items');
            $item->img_url = str_replace('public/', '', $path);
        }

        $item->save();
        $item->categories()->sync($request->category_ids);

        return redirect()->route('mypage')->with('success', '商品を出品しました');
    }

}
