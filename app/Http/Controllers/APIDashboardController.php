<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class APIDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts()->with('category')->get();

        return response()->json([
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
