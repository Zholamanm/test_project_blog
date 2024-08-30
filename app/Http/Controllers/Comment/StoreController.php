<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|min:15',
        ]);

        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        return redirect()->route('post.show', $post->id)->with('success', 'Comment added successfully.');
    }
}
