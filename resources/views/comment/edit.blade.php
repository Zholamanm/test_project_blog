@extends('layouts.app')

@section('content')
    <div class="edit-comment-container">
        <h1>Edit Comment</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="edit-comment-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="body">Comment</label>
                <textarea name="body" id="body" rows="3" class="form-control" required>{{ old('body', $comment->body) }}</textarea>
                @error('body')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Comment</button>
            </div>
        </form>

        <div class="back-link">
            <a href="{{ route('post.show', $comment->post_id) }}" class="btn btn-light">Back to Post</a>
        </div>
    </div>
@endsection

<style>
    .edit-comment-container {
        max-width: 600px;
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

    .edit-comment-form .form-group {
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

    .error-message {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 5px;
    }

    .back-link {
        text-align: center;
        margin-top: 20px;
    }

    .btn-light {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 4px;
        background-color: #f8f9fa;
        color: #333;
        text-decoration: none;
        border: 1px solid #ced4da;
        cursor: pointer;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
    }
</style>
