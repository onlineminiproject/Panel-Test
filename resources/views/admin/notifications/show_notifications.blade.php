@extends('admin.layouts.master')

@section('content')
    <style>
        #data_table th:nth-child(1) {
            width: 5%;
        }

        #data_table th:nth-child(2) {
            width: 5%;
        }

        #data_table th:nth-child(3) {
            width: 15%;
        }

        #data_table th:nth-child(4) {
            width: 30%;
        }

        #data_table th:nth-child(5) {
            width: 10%;
        }

        #data_table th:nth-child(6) {
            width: 10%;
        }

        #data_table th:nth-child(7) {
            width: 10%;
        }

        #data_table th:nth-child(8) {
            width: 15%;
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Sent Notifications</h2>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($notifications->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No notifications sent yet.
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Data Table</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="data_table" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="nosort">&nbsp;</th>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Body</th>
                                                    <th>Topic</th>
                                                    <th>Date</th>
                                                    <th class="nosort">Image</th>
                                                    <th>Data</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notifications as $notification)
                                                    <tr>
                                                        <td>
                                                            <div class="table-actions">
                                                                <a
                                                                    href="{{ route('single.notifications.show', $notification->id) }}"><i
                                                                        class="ik ik-eye"></i></a>
                                                                <br>
                                                                <form
                                                                    action="{{ route('notifications.edit', $notification->id) }}"
                                                                    method="GET"
                                                                    onsubmit="return confirm('Are you sure you want to EDIT this notification?');"
                                                                    style="display: inline;">
                                                                    <button type="submit"
                                                                        style="background: none; border: none; padding: 0; margin: 0;">
                                                                        <i class="ik ik-edit-2"></i>
                                                                    </button>
                                                                </form>
                                                                <p></p>
                                                                <form
                                                                    action="{{ route('notifications.destroy', $notification->id) }}"
                                                                    method="POST" style="display:inline;"
                                                                    onsubmit="return confirm('Are you sure you want to DELETE this notification?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        style="background:none;border:none;padding:0;">
                                                                        <i class="ik ik-trash-2"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td>{{ $notification->id }}</td>
                                                        <td>{{ $notification->title }}</td>
                                                        <td>
                                                            @if (!empty($notification->body))
                                                                Yes - {{ Str::limit($notification->body, 50) }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ $notification->topic }}</td>
                                                        <td>{{ $notification->date }}</td>
                                                        <td>
                                                            @if ($notification->image)
                                                                <img src="{{ $notification->image }}" alt="Image"
                                                                    class="img-thumbnail" width="200">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($notification->data)
                                                                @foreach (json_decode($notification->data, true) as $key => $value)
                                                                    <strong>{{ $key }}:</strong>
                                                                    {{ Str::limit($value, 10) }} <br>
                                                                @endforeach
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Initialize Bootstrap tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
