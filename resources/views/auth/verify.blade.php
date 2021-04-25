@extends('layouts.auth')

@section('content')
    <div class="mt-5 row container-fluid justify-content-center">

        <div class="col-3 card login-form">
            <div class="card-body">
                <h3 class="card-title fs-3 text-center">Verify your Email</h3>

                <p class="mt-5 mb-4 card-text fs-6">Before proceeding, please check your email for a verification link.</p>

                <p class="lead fs-6">{{ __('If you did not receive the email') }},</p>
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                </form>
            </div>
        </div>
    </div>
@endsection
