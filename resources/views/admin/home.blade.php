@extends('layouts.admin')

@section('title', 'Admin Home')

@section('content')
    <h1>Welcome, admin!</h1>

    <h2>Admin Dashboard</h2>
    <div class="button-container">
        <div class="button">
            <a href="{{ route('users.index') }}" class="btn-primary">
                CRUD User
            </a>
        </div>
        <div class="button">
            <a href="{{ route('videos.index') }}" class="btn-primary">
                CRUD Video
            </a>
        </div>
        <div class="button">
            <a href="{{ route('requests.index') }}" class="btn-primary">
                Verifikasi Permintaan Akses
            </a>
        </div>
    </div>
@endsection
