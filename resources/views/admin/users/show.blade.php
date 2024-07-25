@extends('layouts.admin')

@section('content')
    <h1>View User</h1>

    <div>
        <h2>User Details</h2>
        <ul>
            <li><strong>ID:</strong> {{ $user->id_user }}</li>
            <li><strong>Username:</strong> {{ $user->username }}</li>
        </ul>
    </div>

    <div>
        <a href="{{ route('users.index') }}">Back to Users List</a>
        <a href="{{ route('users.edit', ['user' => $user->id_user]) }}">Edit User</a>
        <form action="{{ route('users.destroy', ['user' => $user->id_user]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
        </form>
    </div>
@endsection
