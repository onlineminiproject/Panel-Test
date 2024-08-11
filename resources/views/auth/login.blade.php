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
    max-width: 200px; /* or any desired width */
    height: 200px;    /* or any desired height */
    object-fit: contain; /* ensures the entire image fits within the given dimensions */
}


</style>

    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('{{ asset('hub/img/auth/login-bg.jpg') }}');">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto">
                        <div class="custom-logo-container">
                            <img src="{{ asset('pic/andironvalley2_mypic.png') }}" alt="Andiron Valley Logo">
                        </div>
                        <h3>Sign In</h3>
                        <p>Happy to see you again!</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="username">
                                <i class="ik ik-user"></i>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="form-group relative">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Password" required autocomplete="current-password">
                                <i class="ik ik-eye absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer"
                                    id="togglePassword"></i>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                            </div>

  
                            <div class="row">
                                <div class="col text-left">
                                    {{-- <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                        <span class="custom-control-label">&nbsp;Remember Me</span>
                                    </label> --}}
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>
                            </div>

                            <div class="sign-btn text-center">
                                <button type="submit" class="btn btn-theme">Sign In</button>
                            </div>
                        </form>
                        {{-- <div class="register">
                            <p>Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
