@extends('admin.layouts.master')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Send Firebase Notification</h2>

            @if(session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('send.notification') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" required>{{ old('body') }}</textarea>
                    @error('body')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Topic</label>
                    <select name="topic" class="form-control">
                        <option value="">Please select</option>

                        @foreach (App\Models\Topic::all() as $topic)
                               <option value="{{ $topic->topic_name }}">{{ $topic->topic_name }}</option>
                        @endforeach
                    </select>

                    @error('topic')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="data">Data</label>
                    <div id="data-container">
                        <div class="data-item">
                            <input type="text" class="form-control mb-2" name="data[0][key]" placeholder="Key">
                            <input type="text" class="form-control mb-2" name="data[0][value]" placeholder="Value">
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addDataField()">Add Another Key-Value Pair</button>
                    <button type="button" class="btn btn-info" onclick="pasteData()">Paste</button>
                </div>
                <button type="submit" class="btn btn-primary margin-bottom">Send Notification</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Initialize date picker
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.datepicker', {
            dateFormat: 'Y-m-d H:i:S',
            enableTime: true,
            time_24hr: true,
            enableSeconds: true,
            onOpen: function(selectedDates, dateStr, instance) {
                    if (!instance.input.value) {
                        instance.setDate(new Date());
                    }
                }
        });
    });

    let dataCount = 1;
    function addDataField() {
        const container = document.getElementById('data-container');
        const newDataItem = document.createElement('div');
        newDataItem.classList.add('data-item');
        newDataItem.innerHTML = `
            <input type="text" class="form-control mb-2" name="data[${dataCount}][key]" placeholder="Key">
            <input type="text" class="form-control mb-2" name="data[${dataCount}][value]" placeholder="Value">
        `;
        container.appendChild(newDataItem);
        dataCount++;
    }

    function pasteData() {
        const dataItems = document.querySelectorAll('.data-item input[placeholder="Key"]');
        dataItems.forEach(item => {
            item.value = 'key_link_fcm'; // Replace with actual data
        });
    }
</script>

<!-- Include flatpickr CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@endsection
