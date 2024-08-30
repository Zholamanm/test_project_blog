<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    @error('name')
    <div>{{ $message }}</div>
    @enderror

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    @error('email')
    <div>{{ $message }}</div>
    @enderror

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    @error('password')
    <div>{{ $message }}</div>
    @enderror

    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <button type="submit">Register</button>
</form>
<a href="{{ route('login') }}">Already have an account? Login here.</a>
</body>
</html>
