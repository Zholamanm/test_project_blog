@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <div>
        <h2>Welcome, {{ Auth::user()->name }}!</h2>
        <p>You are logged in as {{ Auth::user()->email }}</p>
    </div>

    <div>
        <h3>Your Posts</h3>

        @if($posts->count() > 0)
            <ul>
                @foreach($posts as $post)
                    <li>
                        <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                        <small>in {{ $post->category->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                        @can('update', $post)
                            <a href="{{ route('post.edit', $post->id) }}">Edit</a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        @endcan
                    </li>
                @endforeach
            </ul>
        @else
            <p>You haven't created any posts yet. <a href="{{ route('post.create') }}">Create your first post</a></p>
        @endif
    </div>

    <div>
        <a href="{{ route('post.create') }}">Create New Post</a>
    </div>
@endsection
