@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Welcome, {{ Auth::user()->username }}</h1>

    <h2>Available Videos</h2>
    <ul>
        @foreach($videos as $video)
            <li>
                <strong>{{ $video->title_video }}</strong>
                @php
                    $hasAccess = false;
                    $request = null;
                    foreach ($requests as $req) {
                        if ($req->id_video == $video->id_video) {
                            $hasAccess = $req->allow_access;
                            $request = $req;
                            break;
                        }
                    }
                @endphp

                @if ($hasAccess)
                    <p>Access granted until: {{ $request->time_expired->format('Y-m-d H:i:s') }}</p>
                    <video controls>
                        <source src="{{ asset('storage/' . $video->location_video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif ($request)
                    <p>Access expired. Please request access again.</p>
                    <form action="{{ route('user.videos.requestAccess', ['video' => $video->id_video]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Request Access</button>
                    </form>
                @else
                    <form action="{{ route('user.videos.requestAccess', ['video' => $video->id_video]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Request Access</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
@endsection
