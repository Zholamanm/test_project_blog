<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }
}
