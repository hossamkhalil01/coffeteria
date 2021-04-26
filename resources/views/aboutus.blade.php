@extends('layouts.auth')

@section('content')
<style>
    body {
        background-image: none;
    }

    h1 {
        font-size: 100px;
        color: white;
    }

    h2 {
        font-size: 1.8em;
        font-weight: bolder;
    }

    h3 {
        font-size: 1.17em;
        font-weight: thin;
        color: whitesmoke;
    }

    hr {
        opacity: 0.1;
        height: 3px !important;
    }

    .img-header {
        object-fit: cover;
        width: 100%;
        opacity: 0.6;
    }

    .image-row {
        position: relative;
    }

    .header-row {
        position: absolute;
        top: 30%;
        left: 30%;
    }

    .image-div {
        background: black;
    }

    .content-row {
        background-color: #eadfd2;
    }
</style>
<div class="container-fluid p-0 m-0">
    <div class="row justify-content-center image-row">
        <div class="col-md-12 image-div">
            <img src="{{asset('images/table.jpg')}}" class="img-header" alt="">
        </div>
    </div>
    <div class="header-row">
        <h1 class="fw-bold text-center ">THE CREATORS</h1>
        <h3 class="text-center">A team of passionate individuals who have a love for coding and programming.</h3>
    </div>
    <div class="content-row">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3">
                <h2 class="text-center">The Team</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <img src="" alt="">
            </div>
        </div>
    </div>
</div>
@endsection