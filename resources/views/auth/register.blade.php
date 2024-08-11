{{-- Selecting Only, Admin can able to register assistants --}}
@extends('admin.layouts.master')

@section('content')
    <style>
        .custom-logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        .custom-logo-container img {
            max-width: 100%;
            height: auto;
        }

        .custom-logo-container img {
            max-width: 200px;
            /* or any desired width */
            height: 200px;
            /* or any desired height */
            object-fit: contain;
            /* ensures the entire image fits within the given dimensions */
        }
    </style>


    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white  align-items-center justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <p></p>

                    <div class="authentication-form mx-auto">
                        <div class="custom-logo-container">
                            <img src="{{ asset('pic/andironvalley1_mypic.png') }}" alt="Andiron Valley Logo">
                        </div>

                        <h3>Register Now</h3>
                        <p>Administrative assistant register page</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name"
                                    value="{{ old('name') }}" required autofocus autocomplete="name">
                                <i class="ik ik-edit-2"></i>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}" required autocomplete="username">
                                <i class="ik ik-user"></i>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>


                            <div class="form-group relative">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Password" required autocomplete="new-password">
                                <i class="ik ik-eye absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                    id="togglePassword"></i>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                            </div>

                            <div class="form-group relative mt-4">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="Confirm Password" required
                                    autocomplete="new-password">
                                <i class="ik ik-eye absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                    id="toggleConfirmPassword"></i>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
                            </div>


                            {{-- <div class="row">
                                <div class="col-12 text-left">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="item_checkbox"
                                            name="item_checkbox" value="option1">
                                        <span class="custom-control-label">&nbsp;I Accept <a href="#">Terms and
                                                Conditions</a></span>
                                    </label>
                                </div>
                            </div> --}}
                            <div class="sign-btn text-center">
                                <button type="submit" class="btn btn-theme">Create Account</button>
                            </div>
                        </form>
                        {{-- <div class="register">
                            <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
