@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    <a href="{{ route('post.create') }}">Create New Post</a>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('post.index') }}" class="filter-form">
        <div>
            <label for="category_id">Filter by Category:</label>
            <select name="category_id" id="category_id" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @auth
            <div>
                <label for="my_posts">
                    <input type="checkbox" name="my_posts" id="my_posts" onchange="this.form.submit()"
                        {{ request('my_posts') ? 'checked' : '' }}>
                    Show My Posts
                </label>
            </div>
        @endauth
    </form>

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                <br>
                <small>Category: {{ $post->category->name }}</small>
                <small>Author: {{ $post->user->name }}</small>
                <br>
                @can('update', $post)
                    <a href="{{ route('post.edit', $post->id) }}">Edit</a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }}

@endsection
