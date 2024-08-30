<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
    }
}
