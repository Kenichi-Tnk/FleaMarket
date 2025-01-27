<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    private function loadItemWithRelations($item_id)
    {
        return Item::with('comments.user', 'categories', 'condition')->findOrFail($item_id);
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
    }
}
