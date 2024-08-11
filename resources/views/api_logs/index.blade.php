@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h1>API Logs</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Method</th>
                    <th>Endpoint</th>
                    <th>Status Code</th>
                    <th>Execution Time (s)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apiLogs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->method }}</td>
                        <td>{{ $log->endpoint }}</td>
                        <td>{{ $log->response_code }}</td>
                        <td>{{ $log->execution_time }}</td>
                        <td>
                            <a href="{{ route('api-logs.show', $log->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('api-logs.destroy', $log->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $apiLogs->links() }}
    </div>
@endsection
