@extends('layouts.admin')

@section('title', 'Requests')

@section('content')
    <h1>Requests</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID Request</th>
                <th>Video ID</th>
                <th>User ID</th>
                <th>Time Accept</th>
                <th>Time Expired</th>
                <th>Allow Access</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $request->id_request }}</td>
                    <td>{{ $request->id_video }}</td>
                    <td>{{ $request->id_user }}</td>
                    <td>{{ $request->time_accept ? \Carbon\Carbon::parse($request->time_accept)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                    <td>{{ $request->time_expired ? \Carbon\Carbon::parse($request->time_expired)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                    <td>{{ $request->allow_access ? 'Granted' : 'Not Granted' }}</td>
                    <td>
                        <form action="{{ route('requests.toggle', ['id_request' => $request->id_request]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-secondary">
                                {{ $request->allow_access ? 'Revoke Access' : 'Grant Access' }}
                            </button>
                        </form>
                        <form action="{{ route('requests.destroy', ['id_request' => $request->id_request]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
