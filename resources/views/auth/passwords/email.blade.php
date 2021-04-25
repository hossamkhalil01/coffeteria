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

@endsection
