@extends('layouts.admin')

@section('content')
    <h1>Users</h1>
    <a href="{{ route('users.create') }}">Create User</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id_user }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <a href="{{ route('users.show', ['user' => $user->id_user]) }}">View</a>
                        <a href="{{ route('users.edit', ['user' => $user->id_user]) }}">Edit</a>
                        <form action="{{ route('users.destroy', ['user' => $user->id_user]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

