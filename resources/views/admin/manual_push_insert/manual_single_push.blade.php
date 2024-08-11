@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Notification Details</h2>
                <div class="card mt-4">
                    <div class="card-header">
                        <h3><strong>Title:</strong> <br> {{ $notification->title }}</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Body:</strong> <br> {{ $notification->body ?? 'N/A' }}</p>
                        <p><strong>Date:</strong> <br> {{ $notification->date }}</p>
                        <p><strong>Image:</strong>
                        <p></p>
                        <td>
                            @if ($notification->image)
                                <img src="{{ route('serve-image', ['url' => $notification->image]) }}"
                                    alt="Notification Image" class="img-thumbnail" width="100">
                            @else
                                <p>No image available.</p>
                            @endif
                        </td>
                        </p>
                        <p><strong>News Link:</strong>
                            @if ($notification->data)
                                <ul>
                                    @foreach (json_decode($notification->data, true) as $key => $value)
                                        <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ $link_trigger }}" target="_blank" class="btn btn-primary">Open Link in New Tab</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
