<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div>
            <label for="username_admin">Username</label>
            <input type="text" name="username_admin" id="username_admin" required>
        </div>
        <div>
            <label for="password_admin">Password</label>
            <input type="password" name="password_admin" id="password_admin" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>
