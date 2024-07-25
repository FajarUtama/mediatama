@extends('layouts.app')

@section('title', 'Create Video')

@section('content')
    <h1>Create Video</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title_video">Video Title:</label>
            <input type="text" name="title_video" id="title_video" required>
        </div>
        <div>
            <label for="video_file">Upload Video:</label>
            <input type="file" name="video_file" id="video_file" accept="video/*" required>
        </div>
        <button type="submit">Create Video</button>
    </form>
@endsection
