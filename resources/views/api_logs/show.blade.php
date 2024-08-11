@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>{{ $queryTitle }}</h1>

    <div class="dropdown mb-4">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="queryDropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Switch Query
        </button>
        <div class="dropdown-menu" aria-labelledby="queryDropdown">
            <a class="dropdown-item" href="{{ route('api-logs.query', 'all-requests') }}">All API Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'successful-requests') }}">Successful API Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'redirected-requests') }}">Redirected API Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'most-called-endpoints') }}">Most Called Endpoints</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'unique-tokens') }}">Unique Token Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'calls-by-date') }}">API Calls Over Date</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'calls-by-month') }}">API Calls Over Month</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'daily-unique-tokens') }}">Daily Unique Token Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'monthly-unique-tokens') }}">Monthly Unique Token Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'status-codes-summary') }}">Status Codes Summary</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'failed-requests') }}">Failed API Calls</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'error-codes') }}">Most Common Error Codes</a>
            <a class="dropdown-item" href="{{ route('api-logs.query', 'slowest-calls') }}">Slowest API Calls</a>
        </div>
    </div>

    <!-- Display query results here -->
    @php
        // Determine Which Columns to Display
        $showId = $data->pluck('id')->filter()->isNotEmpty();
        $showMethod = $data->pluck('method')->filter()->isNotEmpty();
        $showEndpoint = $data->pluck('endpoint')->filter()->isNotEmpty();
        $showResponseCode = $data->pluck('response_code')->filter()->isNotEmpty();
        $showExecutionTime = $data->pluck('execution_time')->filter()->isNotEmpty();
        $showCreatedAt = $data->pluck('created_at')->filter()->isNotEmpty();
        $showDate = $data->pluck('date')->filter()->isNotEmpty();
        $showMonth = $data->pluck('month')->filter()->isNotEmpty();
        $showToken = $data->pluck('token')->filter()->isNotEmpty();
        $showTotal = $data->pluck('total')->filter()->isNotEmpty();
    @endphp

    <div style="overflow-x: auto;">
        <table id="data_table" class="table table-bordered">
            <thead>
                <tr>
                    @if ($showId)
                        <th>ID</th>
                    @endif
                    @if ($showMethod)
                        <th>Method</th>
                    @endif
                    @if ($showEndpoint)
                        <th>Endpoint</th>
                    @endif
                    @if ($showResponseCode)
                        <th>Status Code</th>
                    @endif
                    @if ($showExecutionTime)
                        <th>Execution Time (s)</th>
                    @endif
                    @if ($showCreatedAt)
                        <th>Created At</th>
                    @endif
                    @if ($showDate)
                        <th>Date</th>
                    @endif
                    @if ($showMonth)
                        <th>Month</th>
                    @endif
                    @if ($showToken)
                        <th>Token: Total Unique: {{ App\Models\ApiLog::where('token', 'NOT LIKE', '%server')->distinct('token')->count('token') }}</th>
                    @endif
                    @if ($showTotal)
                        <th>Total</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        @if ($showId)
                            <td>{{ $item->id }}</td>
                        @endif
                        @if ($showMethod)
                            <td>{{ $item->method }}</td>
                        @endif
                        @if ($showEndpoint)
                            <td>{{ $item->endpoint }}</td>
                        @endif
                        @if ($showResponseCode)
                            <td>{{ $item->response_code }}</td>
                        @endif
                        @if ($showExecutionTime)
                            <td>{{ $item->execution_time }}</td>
                        @endif
                        @if ($showCreatedAt)
                            <td>{{ $item->created_at }}</td>
                        @endif
                        @if ($showDate)
                            <td>{{ $item->date }}</td>
                        @endif
                        @if ($showMonth)
                            <td>{{ $item->month }}</td>
                        @endif
                        @if ($showToken)
                            <td>{{ $item->token }}</td>
                        @endif
                        @if ($showTotal)
                            <td>{{ $item->total }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <!-- Include DataTables JS -->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data_table').DataTable({
                "paging": true,       // Enable pagination
                "lengthChange": true, // Allow user to change the number of records per page
                "searching": true,    // Enable searching
                "ordering": true,     // Enable sorting
                "info": true,         // Display info about the table
                "autoWidth": false,   // Disable auto-width adjustment
                "pageLength": 10,     // Default number of records per page
                "lengthMenu": [5, 10, 25, 50, 100], // Options for the number of records per page
                "order": [],          // Default sorting (empty array for no initial sorting)
                "columnDefs": [
                    { "orderable": false, "targets": [0] }, // Disable sorting on the ID column
                    { "searchable": false, "targets": [0] } // Disable searching on the ID column
                ]
            });
        });
    </script>
@endsection
