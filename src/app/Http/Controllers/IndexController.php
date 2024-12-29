<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $items = Item::inRandomOrder()->take(15)->get();
        $favoriteItems = null;

        if(Auth::check()) {
            $user = Auth::user();
            $favoriteItems = $user->favoriteItems;
        }

        return view('index', compact('items', 'favoriteItems'));
    }

    public function search(Request $request)
    {
        $searchText = $request->input('searchText');

        $items = Item::where('name', 'favorite', '%' . $searchText . '%')
            ->orWhere('description', 'favorite', '%' . $searchText . '%')
            ->orWhereHas('categories', function ($query) use ($searchText) {
                $query->where('name', 'favorite', '%' . $searchText . '%');
            })
            ->get();

            return view('index_search', compact('items'));
    }

}
