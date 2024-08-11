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
                        <form method="POST" action="{{ route('manual.notifications.update', $notification->id) }}" id="notificationForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title"  placeholder="Give Your News Title"
                                value="{{ old('title', $notification->title) }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" id="body" name="body"  placeholder="Give Your News Body"  required>{{ old('body', $notification->body) }}</textarea>
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="url" class="form-control" id="image" name="image"   placeholder="Give Image URL"
                                value="{{ old('image', $notification->image) }}">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="date_only">Date</label>
                            <input type="text" class="form-control datepicker" id="date_only" name="date_only" value="{{ old('date_only', \Carbon\Carbon::parse($notification->date)->format('Y-m-d')) }}"   placeholder="Select Date" required>
                            @error('date_only')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time">Time</label>
                            <select class="custom-select" id="time" name="time" required>
                                <option value="">Select a time</option>
                                @foreach($times as $time)
                                    <option value="{{ $time->time }}" {{ old('time', \Carbon\Carbon::parse($notification->date)->format('H:i:s')) == $time->time ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('h:i A') }} - {{ ucfirst($time->status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- The combined date-time will be stored in this hidden input named 'date' -->
                        <input type="hidden" name="date" id="date" value="{{ old('date', $notification->date) }}">

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
                                           {{-- <h5 class="mb-3">Data {{ $loop->iteration }}</h5> --}}
                                           <h5 class="mb-3">Data</h5>
                                           <div class="mb-2">
                                               <label for="data-key-{{ $index }}" class="form-label">Key</label>
                                               <input type="text" id="data-key-{{ $index }}" class="form-control" name="data[{{ $index }}][key]" value="{{ $index }}" placeholder="Key" required readonly>
                                           </div>
                                           <div>
                                               <label for="data-value-{{ $index }}" class="form-label">Value</label>
                                               <input type="url" id="data-value-{{ $index }}" class="form-control" name="data[{{ $index }}][value]" value="{{ $value }}"  placeholder="Give News URL/Link" required>
                                           </div>
                                       </div>
                                   @endif
                               @endforeach
                                @else
                                    <div class="data-item">
                                        <input type="text" class="form-control mb-2" name="data[0][key]"
                                            placeholder="Key">
                                        <input type="url"  class="form-control mb-2" name="data[0][value]"
                                            placeholder="Value">
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="addDataField()"  style="display: none;">Add Another Key-Value
                                Pair</button>
                            <button type="button" class="btn btn-info" onclick="pasteData()" style="display: none;">Paste</button>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block shadow-sm rounded-pill font-weight-bold">
                            <i class="fas fa-save mr-2"></i> Update News
                        </button>

                        </form>
                @else
                    <div class="alert alert-danger" role="alert">
                        No notification found to edit.
                    </div>
                @endif
            </div>
        </div>
    </div>

     <!-- Include flatpickr CSS and JS
        -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize date picker for date only
                flatpickr('.datepicker', {
                    dateFormat: 'Y-m-d',
                    enableTime: false,
                    onOpen: function(selectedDates, dateStr, instance) {
                        if (!instance.input.value) {
                            instance.setDate(new Date());
                        }

                        // Call the pasteData function when the date picker is opened
                        pasteData();
                    }
                });

                // Function to prepare the combined date-time
                function prepareDateTime() {
                    // Get the selected date
                    const date = document.getElementById('date_only').value;

                    // Get the selected time
                    const time = document.getElementById('time').value;

                    if (date && time) {
                        // Combine date and time into a single datetime string
                        const finalDateTime = `${date} ${time}`;

                        // Set the value of the hidden input
                        document.getElementById('date').value = finalDateTime;

                        return true; // Return true to allow form submission
                    } else {
                        // Show an alert if date or time is missing
                        alert("Please select both a date and time.");
                        return false; // Return false to prevent form submission
                    }
                }

                // Attach the function to the form's submit event
                document.getElementById('notificationForm').addEventListener('submit', function(event) {
                    // Prevent form submission if the date or time is not selected
                    if (!prepareDateTime()) {
                        event.preventDefault();
                    }
                });
            });







        let dataCount = {{ isset($data) && is_array($data) ? count($data) : 1 }};

        function addDataField() {
            const container = document.getElementById('data-container');
            const newDataItem = document.createElement('div');
            newDataItem.classList.add('data-item');
            newDataItem.innerHTML = `
            <input type="text" class="form-control mb-2" name="data[${dataCount}][key]" placeholder="Key">
            <input type="url" class="form-control mb-2" name="data[${dataCount}][value]" placeholder="Value">
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
