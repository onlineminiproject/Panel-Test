@extends('admin.layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Edit Notification</h2>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (isset($notification))
                    <form method="POST" action="{{ route('notifications.update', $notification->id) }}"
                        onsubmit="return validateForm()">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $notification->title) }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" id="body" name="body" required>{{ old('body', $notification->body) }}</textarea>
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="text" class="form-control" id="image" name="image"
                                value="{{ old('image', $notification->image) }}">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" class="form-control datepicker" id="date" name="date"
                                value="{{ old('date', $notification->date) }}" required>
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <select class="form-control" id="topic" name="topic" required>
                                <option value="" disabled>Select a topic</option>
                                @foreach (App\Models\Topic::all() as $topic)
                                    <option value="{{ $topic->topic_name }}"
                                        {{ old('topic', $notification->topic) == $topic->topic_name ? 'selected' : '' }}>
                                        {{ $topic->topic_name }}</option>
                                @endforeach
                            </select>
                            @error('topic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="data">Data</label>
                            <div id="data-container">
                                @php
                                    $data = json_decode($notification->data, true);
                                @endphp
                                @if (is_array($data))
                                   @foreach ($data as $index => $value)
                                   @if(!is_null($index) && $index !== "")
                                       <div class="data-item mb-3 p-3 border rounded shadow bg-light">
                                           <h5 class="mb-3">Data {{ $loop->iteration }}</h5>
                                           <div class="mb-2">
                                               <label for="data-key-{{ $index }}" class="form-label">Key</label>
                                               <input type="text" id="data-key-{{ $index }}" class="form-control" name="data[{{ $index }}][key]" value="{{ $index }}" placeholder="Key">
                                           </div>
                                           <div>
                                               <label for="data-value-{{ $index }}" class="form-label">Value</label>
                                               <input type="text" id="data-value-{{ $index }}" class="form-control" name="data[{{ $index }}][value]" value="{{ $value }}" placeholder="Value">
                                           </div>
                                       </div>
                                   @endif
                               @endforeach
                                @else
                                    <div class="data-item">
                                        <input type="text" class="form-control mb-2" name="data[0][key]"
                                            placeholder="Key">
                                        <input type="text" class="form-control mb-2" name="data[0][value]"
                                            placeholder="Value">
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="addDataField()">Add Another Key-Value
                                Pair</button>
                            <button type="button" class="btn btn-info" onclick="pasteData()">Paste</button>
                        </div>
                        <button type="submit" class="btn btn-primary margin-bottom">Update Notification</button>
                    </form>
                @else
                    <div class="alert alert-danger" role="alert">
                        No notification found to edit.
                    </div>
                @endif
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
                enableSeconds: true
            });
        });

        let dataCount = {{ isset($data) && is_array($data) ? count($data) : 1 }};

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
                item.value = 'Developer-given document data'; // Replace with actual data
            });
        }

        function validateForm() {
            const topic = document.getElementById('topic').value;
            if (topic === '') {
                alert('Please select a topic.');
                return false;
            }
            return true;
        }
    </script>

    <!-- Include flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@endsection
