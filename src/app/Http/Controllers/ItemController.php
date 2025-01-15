<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with('comments.user', 'categories', 'condition')->findOrFail($item_id);
    }

    private function checkUserFavorited($item)
    {
        return $item->favoriteUsers()->where('user_id', Auth::id())->exists();
    }

    public function index($item_id)
    {
        $item = $this->loadItemWithRelations($item_id);
        $category = $item->categories->first();

        return view('item', [
            'item' => $item,
            'favoritesCount' => $item->favoriteUsers->count(),
            'commentsCount' => $item->comments->count(),
            'condition' => $item->condition->condition,
            'link' => "/item/comment/{$item_id}",
            'userFavorited' => $this->checkUserFavorited($item),
            'userItem' => $item->user_id == Auth::id(),
        ]);
    }

    public function comment($item_id)
    {
        $item = $this->loadItemWithRelations($item_id);
        $userFavorited = $this->checkUserFavorited($item);
        $comments = $item->comments;

        return view('comment', [
            'item' => $item,
            'comments' => $comments,
            'userFavorited' => $userFavorited,
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
            $path = $request->file('img_url')->store('images', 'public');
            $item->img_url = $path;
        }

        $item->save();
        $item->categories()->sync($request->category_ids);

        return redirect()->route('mypage')->with('success', '商品を出品しました');
    }

    public function update(Request $request, $id)
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

        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->condition_id = $request->condition_id;

        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('images', 'public');
            $item->img_url = $path;
        }

        $item->save();
        $item->categories()->sync($request->category_ids);

        return redirect()->route('mypage')->with('success', '商品情報を更新しました');
    }

    public function favorite($item_id)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->item_id = $item_id;
        $favorite->save();

        return redirect()->back();
    }

    public function unfavorite($item_id)
    {
        Auth::user()->favoriteItems()->detach($item_id);
        return redirect()->back();
    }
}
