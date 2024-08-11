@extends('admin.layouts.master')

@section('content')
<div class="container" style="min-height: 20vh;">
    <div class="text-center mb-4">
        <h2 class="display-4 font-weight-bold text-success">Delete Records from Tables</h2>
    </div>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Card for deleting Top News records -->
    <div class="card mb-4">
        <div class="card-header text-center">
            <h4 class="card-title text-danger">Delete TopNews Records</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('delete-top-news') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete these records?');">
                @csrf
                <div class="form-group">
                    <label for="delete_count" class="form-label" style="font-size: 1.2rem; color: #000000;">Number of Records Deleted from <span style="font-size: 1.5rem; color: #FF5733; font-weight: bold;">TopNews Table</span></label>
                    <input type="number" id="delete_count" name="delete_count" class="form-control" placeholder="Enter number" required>
                </div>
                <button type="submit" class="btn btn-danger btn-lg mt-3">Delete</button>
            </form>
        </div>
    </div>

    <!-- Card for deleting ApiLog records -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title text-danger">Delete ApiLog Records</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('delete-api-log') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete these records?');">
                @csrf
                <div class="form-group">
                    <label for="delete_count" class="form-label" style="font-size: 1.2rem; color: #000000;">Number of Records Deleted from <span style="font-size: 1.5rem; color: #FF5733; font-weight: bold;">ApiLog Table</span></label>
                    <input type="number" id="delete_count" name="delete_count" class="form-control" placeholder="Enter number" required>
                </div>
                <button type="submit" class="btn btn-danger btn-lg mt-3">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
