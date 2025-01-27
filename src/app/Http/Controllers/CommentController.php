<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with('comments.user', 'categories', 'condition', 'favoriteUsers')->findOrFail($item_id);
    }

    public function index($item_id)
    {
        $item = $this->loadItemWithRelations($item_id);
        $comments = $item->comments->map(function ($comment) {
            return [
                'comment' => $comment->comment,
                'UserId' => $comment->user_id,
                'userName' => $comment->user->name,
                'useIcon' => $comment->user->img_url ? asset($comment->user->img_url) : asset('storage/img/default_icon.svg'),
            ];
        });

        dd($comments);

        return view('item_detail', [
            'item' => $item,
            'favoritesCount' => $item->favoriteUsers->count(),
            'commentsCount' => $item->comments->count(),
            'comments' => $comments,
            'userFavorited' => $item->favoriteUsers()->where('user_id', Auth::id())->exists(),
            'userItem' => $item->user_id == Auth::id(),
        ]);
    }

    public function store(CommentRequest $request, $item_id)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id;
        $comment->item = $item_id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()-route('item.show', ['item_id' => $item_id])->with('success', 'コメントを追加しました');
    }
}
