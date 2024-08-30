@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="body">Comment</label>
            <textarea name="body" id="body" rows="3" required>{{ old('body', $comment->body) }}</textarea>
            @error('body')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update Comment</button>
    </form>

    <a href="{{ route('post.show', $comment->post_id) }}">Back to Post</a>
@endsection
