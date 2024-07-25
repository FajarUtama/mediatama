@extends('layouts.admin')

@section('content')
    <h1>Request Access Detail</h1>
    <ul>
        <li><strong>ID Request:</strong> {{ $request->id_request }}</li>
        <li><strong>Video ID:</strong> {{ $request->id_video }}</li>
        <li><strong>User ID:</strong> {{ $request->id_user }}</li>
        <li><strong>Admin ID:</strong> {{ $request->id_admin }}</li>
        <li><strong>Time Accepted:</strong> {{ $request->time_accept ? $request->time_accept->format('Y-m-d H:i:s') : 'Not Accepted' }}</li>
        <li><strong>Time Expired:</strong> {{ $request->time_expired ? $request->time_expired->format('Y-m-d H:i:s') : 'N/A' }}</li>
        <li><strong>Allow Access:</strong> {{ $request->allow_access ? 'Yes' : 'No' }}</li>
    </ul>
    <a href="{{ route('requests.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
