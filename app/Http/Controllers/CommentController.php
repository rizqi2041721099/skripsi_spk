<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'restaurant_id' => 'nullable',
            'star_rating' => 'required',
            'content' => 'required',
        ]);

        $data = Comment::create([
            'restaurant_id' => $data['restaurant_id'],
            'user_id'       => auth()->user()->id,
            'parent_id'     => $request->input('parent_id'),
            'content'       => $data['content'],
            'star_rating'   => $data['star_rating'],
        ]);

        if($data){
            return response()->json([
                'success'   => true,
                'message'   => 'Komentar berhasil ditambahkan',
            ]);
        }else{
            return response()->json([
                'success'   => fasle,
                'message'   => 'Komentar gagal ditambahkan'
            ]);
        }
    }

    public function like(Request $request, Comment $comment)
    {
        $comment->increment('likes');
        return response()->json([
            'likes' => $comment->likes
        ]);
    }

    public function getLikes(Request $request, $id)
    {
        $comment = Comment::find($id);
        return response()->json([
            'likes' => $comment->likes
        ]);
    }

    public function show(Comment $comment)
    {
    }

    public function edit(Comment $comment)
    {
    }

    public function update(Request $request, Comment $comment)
    {
    }

    public function destroy(Comment $comment)
    {
    }
}
