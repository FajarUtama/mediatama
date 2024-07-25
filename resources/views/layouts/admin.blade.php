<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.home') }}">Home</a></li>
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                    <li><a href="{{ route('videos.index') }}">Videos</a></li>
                    <li><a href="{{ route('requests.index') }}">Requests</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
        </footer>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
