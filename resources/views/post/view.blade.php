@extends('layouts.app')

@section('content')
    <div class="post-detail-container">
        <h1>{{ $post->title }}</h1>

        <div class="post-meta">
            <div><strong>Category:</strong> {{ $post->category->name }}</div>
            <div><strong>Author:</strong> {{ $post->user->name }}</div>
            <div><strong>Created at:</strong> {{ $post->created_at->format('M d, Y') }}</div>
        </div>

        <div class="post-body">
            <p>{{ $post->body }}</p>
        </div>

        <div class="post-actions">
            @can('update', $post)
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
            @endcan

            @can('delete', $post)
                <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endcan
        </div>

        <h2>Comments</h2>

        @if ($post->comments->count())
            <ul class="comments-list">
                @foreach ($post->comments as $comment)
                    <li class="comment-item">
                        <p>{{ $comment->body }}</p>
                        <small>By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y H:i') }}</small>

                        <div class="comment-actions">
                            @can('update', $comment)
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            @endcan

                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No comments yet.</p>
        @endif

        <h3>Add a Comment</h3>

        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="add-comment-form">
            @csrf
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea name="body" id="body" rows="3" class="form-control" required>{{ old('body') }}</textarea>
                @error('body')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>

        <div class="back-link">
            <a href="{{ route('post.index') }}" class="btn btn-light">Back to Posts</a>
        </div>
    </div>
@endsection

<style>
    .post-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2, h3 {
        margin-bottom: 20px;
    }

    .post-meta {
        margin-bottom: 20px;
        color: #6c757d;
    }

    .post-body {
        margin-bottom: 30px;
    }

    .post-actions {
        margin-bottom: 30px;
    }

    .post-actions .btn {
        margin-right: 10px;
    }

    .comments-list {
        list-style: none;
        padding: 0;
        margin-bottom: 30px;
    }

    .comment-item {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        background-color: #fff;
    }

    .comment-actions {
        margin-top: 10px;
    }

    .comment-actions .btn {
        margin-right: 5px;
    }

    .add-comment-form {
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn-primary {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.875em;
    }

    .inline-form {
        display: inline;
    }

    .back-link {
        text-align: center;
        margin-top: 20px;
    }
</style>
