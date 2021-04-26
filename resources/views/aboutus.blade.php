@extends('layouts.auth')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
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

    .avatar-img {
        border-radius: 50%;
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
        <div class="row justify-content-center mt-3">
            <div class="col-md-2 text-center">
                <img src="{{asset('images/avatars/avatar1.jpg')}}" class="avatar-img" alt="">
                <p class="text-center">Hossam Khalil</p>
                <i class="fab fa-github"></i>
            </div>
            <div class="col-md-2 text-center">
                <img src="{{asset('images/avatars/avatar2.jpg')}}" class="avatar-img" alt="">
                <p class="text-center">Leena Sherif</p>
            </div>
            <div class="col-md-2 text-center">
                <img src="{{asset('images/avatars/avatar3.jpg')}}" class="avatar-img" alt="">
                <p class="text-center">Sarah Magdy</p>
            </div>
            <div class="col-md-2 text-center">
                <img src="{{asset('images/avatars/avatar4.jpg')}}" class="avatar-img" alt="">
                <p class="text-center">Mai Maher</p>
            </div>
        </div>
    </div>
</div>
@endsection