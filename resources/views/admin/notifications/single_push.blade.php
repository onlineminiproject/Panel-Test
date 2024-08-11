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
                    <p><strong>Topic:</strong> <br> {{ $notification->topic }}</p>
                    <p><strong>Date:</strong> <br> {{ $notification->date }}</p>
                    <p><strong>Image:</strong>
                        <p></p>
                        @if ($notification->image)
                            <img src="{{ $notification->image }}" alt="Image" class="img-thumbnail" width="200">
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Data:</strong>
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
