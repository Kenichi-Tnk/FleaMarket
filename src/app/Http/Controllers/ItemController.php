<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Item;
use App\Models\Favorite;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with( 'comments.user', 'condition', 'categories')->findOrFail($item_id);
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

        $comments = $comments->map(function ($comment) {
            return [
                'comment' => $comment->comment,
                'userId' => $comment->user->id,
                'userName' => $comment->user->name,
                'userIcon' => $comment->user->img_url,
            ];
        });

        $data = [
            'item' => $item,
            'favoritesCount' => $item->favoriteUsers->count(),
            'commentsCount' => $item->comments->count(),
            'comments' => $comments,
            'link' => "/item/comment/{$item_id}",
            'userFavorited' => $userFavorited,
        ];

        return view('comment', $data);
    }

    public function store(CommentRequest $request, $item_id)
    {
        $user_id = Auth::id();
        $commentText = $request->input('comment');

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->item_id = $item_id;
        $comment->comment = $commentText;
        $comment->save();

        return redirect()->back()->with('success', 'コメントを追加しました');
    }

    public function favorite($item_id)
    {
        $favorite = new Favorite();
        $favorite->user_id = Auth::id();
        $favorite->item_id = $item_id;
        $favorite->save();

        return redirect()->back()->with('success', 'お気に入りに追加しました');
    }

    public function unfavorite($item_id)
    {
        Auth::user()->favoriteItems()->detach($item_id);

        return redirect()->back()->with('success', 'お気に入りから削除しました');
    }

}
