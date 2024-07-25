@extends('layouts.admin')

@section('content')
    <h1>Verify Request Access</h1>
    <form action="{{ route('requests.verify', $request->id_request) }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="allow_access">Allow Access:</label>
            <select name="allow_access" id="allow_access" class="form-control" required>
                <option value="1" {{ $request->allow_access ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$request->allow_access ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
    <a href="{{ route('requests.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
