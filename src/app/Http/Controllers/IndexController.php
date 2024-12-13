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
        $likeItems = null;

        if(Auth::check()) {
            $user = Auth::user();
            $likeItems = $user->likeItems;
        }

        return view('index', compact('items', 'likeItems'));
    }

}
