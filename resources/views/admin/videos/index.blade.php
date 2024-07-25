@extends('layouts.admin')

@section('content')
    <h1>Videos</h1>
    <a href="{{ route('videos.create') }}">Create Video</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->id_video }}</td>
                    <td>{{ $video->title_video }}</td>
                    <td>{{ $video->location_video }}</td>
                    <td>
                        <a href="{{ route('videos.edit', ['video' => $video->id_video]) }}">Edit</a>
                        <form action="{{ route('videos.destroy', ['video' => $video->id_video]) }}" method="POST" style="display:inline;">
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
