@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Time</h5>
                    <span>Update Time</span>
                </div>
            </div>
        </div>
    <div class="col-lg-4">
        <nav class="breadcrumb-container" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href=""><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Time</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>
    </div>
</div>

<div class="row justify-content-center">
	<div class="col-lg-10">


	<div class="card">
	<div class="card-header"><h3>Add Time</h3></div>
	<div class="card-body">
		<form class="forms-sample" action="{{ route('date-times.update', $dateTime->id) }}" method="post" >@csrf
            @method('PUT')
			<div class="row">
				<div class="col-lg-6">
                    <div class="form-group">

                        <label for="">Time: value: {{ \Carbon\Carbon::createFromFormat('H:i:s', $dateTime->time)->format('h:i A') }}</label>
                        <input type="time" name="time" class="form-control @error('time') is-invalid @enderror" placeholder="Enter Time" value="{{ \Carbon\Carbon::createFromFormat('H:i:s', $dateTime->time)->format('H:i') }}">

                    @error('time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>

            <div class="form-group">


              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
        </div>



				</form>
			</div>
            </div>
		</div>
	</div>
</div>


@endsection
