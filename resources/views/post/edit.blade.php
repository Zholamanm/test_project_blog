@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('post.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>
            @error('title')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="body">Body</label>
            <textarea name="body" id="body" rows="5" required>{{ old('body', $post->body) }}</textarea>
            @error('body')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update Post</button>
    </form>
@endsection
