@extends('layouts.auth')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endpush
@section('content')
    <!--header-->
    {{-- <div class="header-w3l">
        <h1 style="background-color: rgba(100, 109, 100, 0.835)">
            <span>W</span>elcome
            <span>B</span>ack

        </h1>
    </div> --}}
    <!--//header-->
    <div class="main-content-agile">
        <div class="sub-main-w3">
            <h1 class="fs-1 fst-italic text-light mb-5 ">Sign in</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="pom-agile">
                    <span class="fa fa-user-o" aria-hidden="true"></span>
                    <input placeholder="Email" name="email" class="user form-control @error('email') is-invalid @enderror"
                        type="email" value="{{ old('email') }}" required>
                </div>

                <div class="pom-agile">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <input placeholder="Password" name="password" class="pass" type="password" required
                        autocomplete="current-password">
                </div>

                <div class="sub-w3l">
                    <div class="sub-agile">
                        <input type="checkbox" id="brand1" name="remember" value=""
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="brand1">
                            <span></span>Remember me?</label>
                    </div>
                    <div class="clear"></div>
                </div>
                @error('email')
                    <div class="alert alert-danger  mt-4">
                        <span class="" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                @enderror
                <div class="right-w3l">
                    <input type="submit" value="Login">
                </div>
            </form>
            <div class="forgot-w3l">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>

            <div class="row mt-3 mb-4 align-items-baseline">
                <hr class="col-5 text-light fw-bolder or-line">
                <p class="col-2 text-center fs-4 text-light">Or</p>
                <hr class="col-5  text-light fw-bolder or-line">
            </div>

            {{-- Social login section --}}
            <div class="row mt-3 justify-content-center">
                <a href="{{ route('social.oauth', 'facebook') }}"
                    class="btn btn-primary fa fw-bolder fa-facebook fs-3 col-2 me-3" role="button"></a>
                <a href="{{ route('social.oauth', 'google') }}"
                    class="btn btn-danger fa fw-bolder fa-google fs-3 col-2 me-3" role="button"></a>
                <a href="{{ route('social.oauth', 'github') }}" class="btn btn-dark fa fw-bolder fa-github fs-3 col-2 "
                    role="button"></a>
            </div>
            {{-- End of social section --}}

            <div class="sign-up mt-5 mb-0">
                <p class="text-light">Don't have an account? <a class="forgot-w3l" href="{{ route('register') }}">
                        Register</a></p>
            </div>
        </div>
    </div>

@endsection
