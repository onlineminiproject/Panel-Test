{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}



@extends('auth.master.custom_master')

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
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('{{ asset('hub/img/auth/login-bg.jpg') }}')">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">

                    <div class="authentication-form mx-auto">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <p></p>

                        <div class="custom-logo-container">
                            <img src="{{ asset('pic/andironvalley3_mypic.png') }}" alt="Andiron Valley Logo">
                        </div>
                        <h3>Forgot Password</h3>
                        <p>We will send you a link to reset password.</p>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">

                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autofocus placeholder="Your email address"
                                    required="">
                                <i class="ik ik-mail"></i>

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="sign-btn text-center">
                                <button type="submit" class="btn btn-theme">Submit</button>
                            </div>
                        </form>
                        {{-- <div class="register">
                            <p>Not a member? <a href="{{route('register')}}">Create an account</a></p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
