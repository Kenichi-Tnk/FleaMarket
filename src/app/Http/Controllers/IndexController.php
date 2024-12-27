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

}
