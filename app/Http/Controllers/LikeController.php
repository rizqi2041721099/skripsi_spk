<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController
{
    public function like(Request $request, Comment $comment)
    {
        $user = $request->user();

        $like = $comment->likes()->where('user_id', $user->id)->first();

        if ($request->input('type') === 'like') {
            if ($like) {
                if ($like->type === 'like') {
                    $like->delete();
                } else {
                    $like->update(['type' => 'like']);
                }
            } else {
                $comment->likes()->create(['user_id' => $user->id, 'type' => 'like']);
            }
        } else {
            if ($like) {
                if ($like->type === 'dislike') {
                    $like->delete();
                } else {
                    $like->update(['type' => 'dislike']);
                }
            } else {
                $comment->likes()->create(['user_id' => $user->id, 'type' => 'dislike']);
            }
        }

        $likesCount = $comment->likes()->where('type', 'like')->count();
        $dislikesCount = $comment->likes()->where('type', 'dislike')->count();

        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount,
            'hasLiked' => $comment->hasLiked($user),
            'hasDisliked' => $comment->hasDisliked($user),
        ]);
    }
}
