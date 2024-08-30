@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <h1>Dashboard</h1>

        <div class="welcome-message">
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
            <p>You are logged in as {{ Auth::user()->email }}</p>
        </div>

        <div class="user-posts">
            <h3>Your Posts</h3>

            @if($posts->count() > 0)
                <ul class="posts-list">
                    @foreach($posts as $post)
                        <li class="post-item">
                            <a href="{{ route('post.show', $post->id) }}" class="post-title">{{ $post->title }}</a>
                            <small>in {{ $post->category->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                            <div class="post-actions">
                                @can('update', $post)
                                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline-form">
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
                <p>You haven't created any posts yet. <a href="{{ route('post.create') }}">Create your first post</a></p>
            @endif
        </div>

        <div class="create-post-link">
            <a href="{{ route('post.create') }}" class="btn btn-primary">Create New Post</a>
        </div>
    </div>
@endsection

<style>
    .dashboard-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .welcome-message {
        margin-bottom: 30px;
        text-align: center;
    }

    .user-posts {
        margin-bottom: 30px;
    }

    .posts-list {
        list-style: none;
        padding: 0;
    }

    .post-item {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        background-color: #fff;
    }

    .post-title {
        font-size: 1.25em;
        font-weight: bold;
        color: #007bff;
        text-decoration: none;
    }

    .post-actions {
        margin-top: 10px;
    }

    .post-actions .btn {
        margin-right: 5px;
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

    .btn-sm {
        padding: 5px 10px;
        font-size: 0.875em;
    }

    .inline-form {
        display: inline;
    }

    .create-post-link {
        text-align: center;
        margin-top: 20px;
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
</style>
