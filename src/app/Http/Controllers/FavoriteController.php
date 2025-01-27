<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with('comments.user', 'categories', 'condition', 'favoriteUsers')->findOrFail($item_id);
    }

    public function store($item_id)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->item_id = $item_id;
        $favorite->save();

        $item = $this->loadItemWithRelations($item_id);

        return redirect()->back()->with([
            'success', 'お気に入りに追加しました',
            'favoritesCount' => $item->favoriteUsers->count()
        ]);
    }

    public function destroy($item_id)
    {
        Auth::user()->favoriteItems()->detach($item_id);

        $item = $this->loadItemWithRelations($item_id);

        return redirect()->back()->with([
            'success', 'お気に入りから削除しました',
            'favoritesCount' => $item->favoriteUsers->count()
        ]);
    }

    public function count($item_id)
    {
        $item = Item::withCount('favoriteUsers')->findOrFail($item_id);
        return response()->json(['favoritesCount' => $item->favorite_users_count]);
    }
}
