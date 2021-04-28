@extends('layouts.auth')

@push('styles')
@endpush

@section('content')

    <div class="main-content-agile">
        <div class="sub-main-w3">
            <h1 class="fs-1 fst-italic text-light mb-5 ">Register</h1>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="pom-agile">
                    <span class="fa fa-user-o" aria-hidden="true"></span>
                    <input placeholder="Name" name="name" class="user form-control @error('name') is-invalid @enderror"
                        type="text" value="{{ old('name') }}" required>
                </div>

                <div class="pom-agile">
                    <span class="fa fa-user-o" aria-hidden="true"></span>
                    <input placeholder="Email" name="email" class="user form-control @error('email') is-invalid @enderror"
                        type="email" value="{{ old('email') }}" required>
                </div>

                <div class="pom-agile">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <input placeholder="Password" name="password"
                        class="pass form-control @error('password') is-invalid @enderror" type="password" required
                        autocomplete="new-password">
                </div>

                <div class="pom-agile">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <input placeholder="Confirm Password" name="password_confirmation" class="pass form-control"
                        type="password" required autocomplete="new-password">
                </div>

                <div class="pom-agile">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <select name="room_id" class="user form-control @error('room_id') is-invalid @enderror" name="room_id"
                        style="width:91%">
                        <option disabled selected>Room No.</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room['id'] }}" @if ($room['id'] == old('room_id')) selected="selected" @endif>
                                {{ $room['number'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pom-agile">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <div class="row align-items-baseline">
                        <label class="col-4" for="avatar">Avatar(optional)</label>
                        <input id="avatar" type="file" class="col-4 form-control" name="avatar" style="width:60%">
                    </div>
                </div>

                @if ($errors->any())
                    <ul class="row justify-content-strat alert alert-danger mt-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="right-w3l">
                    <input type="submit" value="Register">
                </div>
            </form>

            <div class="sign-up mt-5 mb-0">
                <p class="text-light">Already have an account? <a class="forgot-w3l" href="{{ route('login') }}">
                        Sign in</a></p>
            </div>
        </div>
    </div>

@endsection

{{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="room_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Room No.') }}</label>

                                <div class="col-md-6">
                                    <select name="room_id" class="form-control @error('room_id') is-invalid @enderror"
                                        name="room_id">
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room['id'] }}" @if ($room['id'] == old('room_id')) selected="selected" @endif>
                                                {{ $room['number'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('room_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="avatar"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture (optional)') }}</label>

                                <div class="col-md-6">
                                    <input id="avatar" type="file" class="form-control" name="avatar">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
