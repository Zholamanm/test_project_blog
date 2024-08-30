<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'body' => 'required|string|min:15',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('post.show', $comment->post_id)->with('success', 'Comment updated successfully.');
    }
}
