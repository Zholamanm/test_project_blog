<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Post::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('my_posts') && Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        $posts = $query->with('user', 'category')->paginate(10);
        $categories = Category::all();

        return view('post.index', compact('posts', 'categories'));
    }
}
