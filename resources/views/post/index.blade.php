@extends('layouts.app')

@section('content')
    <div class="posts-container">
        <h1>Posts</h1>

        <div class="actions">
            <a href="{{ route('post.create') }}" class="btn btn-primary">Create New Post</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('post.index') }}" class="filter-form">
            <div class="form-group">
                <label for="category_id">Filter by Category:</label>
                <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @auth
                <div class="form-group">
                    <label for="my_posts" class="checkbox-label">
                        <input type="checkbox" name="my_posts" id="my_posts" onchange="this.form.submit()"
                            {{ request('my_posts') ? 'checked' : '' }}>
                        Show My Posts
                    </label>
                </div>
            @endauth
        </form>

        <ul class="posts-list">
            @foreach($posts as $post)
                <li class="post-item">
                    <a href="{{ route('post.show', $post->id) }}" class="post-title">{{ $post->title }}</a>
                    <div class="post-meta">
                        <small>Category: {{ $post->category->name }}</small>
                        <small>Author: {{ $post->user->name }}</small>
                    </div>
                    <div class="post-actions">
                        @can('update', $post)
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="pagination">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

<style>
    .posts-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .actions {
        margin-bottom: 20px;
        text-align: center;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        margin: 5px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .filter-form {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
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
    }

    .post-title {
        font-size: 1.25em;
        font-weight: bold;
        color: #007bff;
        text-decoration: none;
    }

    .post-meta {
        margin-top: 5px;
        color: #6c757d;
    }

    .post-actions {
        margin-top: 10px;
    }

    .post-actions .btn {
        margin-right: 5px;
    }

    .delete-form {
        display: inline;
    }

    .pagination {
        width: 100%;
        display: flex;
        justify-content: space-evenly;
        margin-top: 20px;
    }
    .pagination nav{
        width: 100%;
    }
</style>
