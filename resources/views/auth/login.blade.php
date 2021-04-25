@extends('layouts.auth')

@push('styles')
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Tangerine:400,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endpush
@section('content')
    <!--header-->
    <div class="header-w3l">
        <h1 style="background-color: rgba(100, 109, 100, 0.835)">
            <span>W</span>elcome
            <span>B</span>ack

        </h1>
    </div>
    <!--//header-->
    <div class="main-content-agile">
        <div class="sub-main-w3">
            <h1 class="fs-1 fst-italic text-light mb-5 ">Sign in</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="pom-agile">
                    <span class="fa fa-user-o" aria-hidden="true"></span>
                    <input placeholder="Email" name="email" class="user" type="text" value="{{ old('email') }}" required>
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
    <!--//main-->
    <!--footer-->
    {{-- <div class="footer">
        <p>&copy; 2018 Portrait Login Form. All rights reserved | Design by
            <a href="http://w3layouts.com">W3layouts</a>
        </p>
    </div> --}}
    <!--//footer-->
@endsection

{{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr />

                            <div class="form-group row align-items-center">
                                <a href="{{ route('social.oauth', 'github') }}" role="btn"
                                    class="w-25 mb-2 m-auto btn btn-dark btn-block">
                                    Login with Github
                                </a>
                            </div>

                            <div class="form-group row align-items-center">
                                <a href="{{ route('social.oauth', 'google') }}" role="btn"
                                    class="w-25 mb-2 m-auto btn btn-danger">
                                    Login with Google
                                </a>
                            </div>


                            <div class="form-group row align-items-center">
                                <a href="{{ route('social.oauth', 'facebook') }}" role="btn"
                                    class="w-25 mb-5 m-auto btn btn-primary">
                                    Login with Facebook
                                </a>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
