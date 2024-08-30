<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('comment.edit', compact('comment'));
    }
}
