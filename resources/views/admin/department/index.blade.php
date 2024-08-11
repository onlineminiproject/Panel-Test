@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-inbox bg-blue"></i>
                <div class="d-inline">
                    <h5>Times</h5>
                    <span>List of all Times</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Time Table</h3>
            </div>
            <div class="card-body">
                <table id="data_table" class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th class="nosort">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($dateTime) > 0)
                            @foreach($dateTime as $key => $time)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('h:i A') }}</td>
                                    <td>{{ $time->status }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('date-times.edit', [$time->id]) }}"><i class="ik ik-edit-2"></i></a>
                                            <form action="{{ route('date-times.destroy', [$time->id]) }}" method="post" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none; background:none; padding:0;"><i class="ik ik-trash-2"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <!-- Include DataTables JS -->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data_table').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": 'nosort' } // Disable sorting on columns with 'nosort' class
                ]
            });
        });
    </script>
@endsection
