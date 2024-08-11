@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-command bg-blue"></i>
                <div class="d-inline">
                    <h5>Time</h5>
                    <span>Create Time</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
	<div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

	<div class="card">
	<div class="card-header"><h3>Add Time</h3></div>
	<div class="card-body">
		<form class="forms-sample" action="{{ route('date-times.store') }}" method="post" >@csrf
			<div class="row">
				<div class="col-lg-6">
                    <div class="form-group">

					<label for="">Give Time</label>
					<input type="time" name="time" class="form-control @error('time') is-invalid @enderror" placeholder="Enter Time" value="{{old('time')}}">
                    @error('department')
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
