@extends('admin.layouts.master')

@section('content')
    <style>
        .dropdownCustom-select {
            height: calc(2.75rem + 2px);
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
            border-radius: 0.25rem;
        }

        .btn-primary {
            background: linear-gradient(90deg, #0062E6, #33AEFF);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #0053C7, #1C93F8);
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Create API Top News</h2>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form method="POST" action="{{ route('manual.save') }}" id="notificationForm">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Give Your News Title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="body" name="body" placeholder="Give Your News Body" required>{{ old('body') }}</textarea>
                        @error('body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image URL</label>
                        <input type="url" class="form-control" id="image" name="image"
                            placeholder="Give Image URL" value="{{ old('image') }}">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                    <label for="time">Time</label>
                    <select class="custom-select" id="time" name="time" required>
                        <option value="">Select a time</option>
                        @foreach ($times as $time)
                            <option  class="dropdownCustom-select"  value="{{ $time->time }}">
                                {{-- {{ \Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('h:i A') }} - {{ ucfirst($time->status) }} --}}
                    {{-- {{ \Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('h:i A')
                            </option>
                        @endforeach
                    </select>
                    @error('time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                    <div class="form-group">
                        <label for="date_only">Date</label>
                        <input type="text" class="form-control datepicker" id="date_only" name="date_only"
                            placeholder="Select Date" value="{{ old('date_only') }}" required>
                        @error('date_only')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    @php
                        // Find the maximum time where status is 0
                        $minTime = $times->where('status', 0)->min('time');
                    @endphp

                    <div class="form-group">
                        <label for="time">Time</label>
                        <div class="d-flex align-items-center">
                            <select class="custom-select" id="time" name="time" required>
                                <option value="">Select a time</option>
                                {{-- @foreach ($times as $time)
                                    @if ($time->status == 0)
                                        <option class="dropdownCustom-select" value="{{ $time->time }}">
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $time->time)->format('i:s') }} -
                                            {{ ucfirst($time->status) }}
                                        </option>
                                    @endif
                                @endforeach --}}

                                @if ($minTime)
                                    <option class="dropdownCustom-select" value="{{ $minTime }}">
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $minTime)->format('i:s') }}
                                    </option>
                                @endif

                            </select>
                            <!-- Reset Button -->
                            <button type="button" class="btn btn-danger ml-3" id="resetButton" onclick="resetStatus()"
                                @if (App\Models\DateTime::where('status', '!=', 1)->count() > 0) disabled @endif>Reset Status</button>
                        </div>
                        @error('time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- The combined date-time will be stored in this hidden input named 'date' -->
                    <input type="hidden" name="date" id="date">


                    <div class="form-group">
                        <label for="data">Data</label>
                        <div id="data-container">
                            <div class="data-item  mb-3 p-3 border rounded shadow bg-light">
                                <input type="text" class="form-control mb-2" name="data[0][key]" placeholder="Key"
                                    required readonly>
                                <input type="url" class="form-control mb-2" name="data[0][value]"
                                    placeholder="Give News URL/Link" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="addDataField()" style="display: none;">Add
                            Another Key-Value
                            Pair</button>
                        <button type="button" class="btn btn-info" onclick="pasteData()"
                            style="display: none;">Paste</button>
                    </div>

                    <!-- Rest of the form fields -->
                    <button id="submitButton" type="submit"
                        class="btn btn-primary btn-lg btn-block shadow-sm rounded text-white font-weight-bold"
                        style="background-color: #007bff; border-color: #007bff;">
                        <i class="fas fa-paper-plane mr-2"></i> Save News
                    </button>

                </form>
            </div>
        </div>
    </div>

    <!-- Include flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        <!-- Include flatpickr CSS and JS
        -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function disableButtonDuringTimeRange() {
            const currentDateTime = new Date();
            const currentSeconds = currentDateTime.getHours() * 3600 + currentDateTime.getMinutes() * 60 +
                currentDateTime.getSeconds();

            // Check if the time is between 00:00:00 (0 seconds) and 00:00:15 (15 seconds)
            if (currentSeconds >= 0 && currentSeconds <= 30) {
                document.getElementById("submitButton").disabled = true;
            } else {
                document.getElementById("submitButton").disabled = false;
            }
        }
        // Call the function when the page loads
        window.onload = disableButtonDuringTimeRange;
        // Optionally, you can continuously check the time every second
        setInterval(disableButtonDuringTimeRange, 1000);





        function resetStatus() {
            if (confirm('Are you sure you want to Reset this Time Status?')) {
                // Redirect to the reset route
                window.location.href = "{{ route('reset.dateTime.status') }}";
            }
        }


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

            //Function to prepare the combined date-time
            function prepareDateTime() {
                // Get the selected date
                const date = document.getElementById('date_only').value;

                // Get the selected time
                const time = document.getElementById('time').value;

                if (date && time) {
                    // Combine date and time into a single datetime string
                    const finalDateTime = `${date} ${time}`;

                    //dd($finalDateTime);

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




        let dataCount = 1;

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
    </script>

    <!-- Include flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection
