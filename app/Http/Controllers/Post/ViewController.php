<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function __invoke(Post $post)
    {
        return view('post.view', compact('post'));
    }
}
