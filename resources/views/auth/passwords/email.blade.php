@extends('layouts.auth')

@section('content')
    <div class="mt-5 row container-fluid justify-content-center">

        <div class="col-3 card login-form">
            <div class="card-body">
                <h3 class="card-title fs-3 text-center">Forgot your password?</h3>

                <p class="mt-5 mb-4 card-text">Don't worry. Resetting your password is easy, just tell us the
                    email address you registered with Coffeteria.</p>

                <div class="mt-4">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">

                            <input name="email" type="email" class="mt-3 form-control form-control-lg" @error('email')
                                is-invalid @enderror" required autocomplete="email" autofocus"
                                placeholder="Email Address" />

                        </div>

                        @if (session('status'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('status') }}
                            </div>

                        @endif
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <li>{{ $message }}</li>
                            </span>
                        @enderror
                        <div class="row">

                            @if (session('status'))

                                <a href="{{ route('login') }}" class="m-auto col-4 mt-5 btn btn-success">Back to Login</a>
                            @else
                                <button type="submit" class="m-auto col-4 mt-5 btn btn-primary ">Send</button>

                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
