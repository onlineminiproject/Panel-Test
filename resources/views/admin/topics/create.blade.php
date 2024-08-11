@extends('admin.layouts.master')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Create New Topic</h2>

            <form method="POST" action="{{ route('topics.store') }}">
                @csrf
                <div class="form-group">
                    <label for="topic_name">Topic Name</label>
                    <input type="text" class="form-control" id="topic_name" name="topic_name" required>
                </div>
                <div class="form-group">
                    <label for="topic_desc">Topic Description</label>
                    <textarea class="form-control" id="topic_desc" name="topic_desc"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Topic</button>
            </form>
        </div>
    </div>
</div>

@endsection
