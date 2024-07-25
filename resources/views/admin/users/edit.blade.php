@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', ['user' => $user->id_user]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password (leave blank if not changing)</label>
            <input type="text" name="password" id="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
