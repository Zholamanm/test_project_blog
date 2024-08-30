@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <div>
        <strong>Category:</strong> {{ $post->category->name }}
    </div>
    <div>
        <strong>Author:</strong> {{ $post->user->name }}
    </div>
    <div>
        <strong>Created at:</strong> {{ $post->created_at->format('M d, Y') }}
    </div>

    <div>
        <p>{{ $post->body }}</p>
    </div>

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

    <h2>Comments</h2>

    @if ($post->comments->count())
        <ul>
            @foreach ($post->comments as $comment)
                <li>
                    <p>{{ $comment->body }}</p>
                    <small>By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y H:i') }}</small>

                    @can('update', $comment)
                        <a href="{{ route('comments.edit', $comment->id) }}">Edit</a>
                    @endcan

                    @can('delete', $comment)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    @else
        <p>No comments yet.</p>
    @endif

    <h3>Add a Comment</h3>

    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div>
            <label for="body">Comment</label>
            <textarea name="body" id="body" rows="3" required>{{ old('body') }}</textarea>
            @error('body')
            <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Add Comment</button>
    </form>

    <a href="{{ route('post.index') }}">Back to Posts</a>
@endsection
