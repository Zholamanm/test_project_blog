<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form action="{{ route('login.post') }}" method="POST">
    @csrf
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

    <button type="submit">Login</button>
</form>

<a href="{{ route('register') }}">Don't have an account? Register here.</a>
</body>
</html>
