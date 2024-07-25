@extends('layouts.admin')

@section('content')
    <h1>Edit Video</h1>

    <form action="{{ route('videos.update', ['video' => $video->id_video]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title_video">Title</label>
            <input type="text" name="title_video" id="title_video" value="{{ old('title_video', $video->title_video) }}" class="form-control" required>
            @error('title_video')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="location_video">Location</label>
            <input type="text" name="location_video" id="location_video" value="{{ old('location_video', $video->location_video) }}" class="form-control" required>
            @error('location_video')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
        <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
