@extends('layouts.auth')

@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        body {
            background-image: none;
            background-color: #eadfd2;
        }

        h1 {
            font-size: 5vw;
            color: white;
        }

        h2 {
            font-size: 1.8vw;
            font-weight: bolder;
        }

        h3 {
            font-size: 1.10vw;
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
            /* left: 30%; */
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

        .icons-link,
        .icons-link:hover,
        .icons-link:active {
            text-decoration: none;
            color: black
        }

        .icons-link:hover {
            cursor: pointer;
        }

        @media screen and (max-width: 800px) {
            h1 {
                font-size: 30px;
            }

            h2 {
                font-size: 20px;
            }

            h3 {
                font-size: 10px;
            }

            .header-row {
                top: 10%;
            }
        }

    </style>
    <div class="container-fluid">
        <div class="image-row">
            <div class="row justify-content-center">
                <div class="col-md-12 image-div p-0 m-0">
                    <img src="{{ asset('images/table.jpg') }}" class="img-header" alt="">
                </div>
                <div class="header-row">
                    <h1 class="fw-bold text-center ">THE CREATORS</h1>
                    <h3 class="text-center">A team of passionate individuals who have a love for coding and programming.
                    </h3>
                </div>
            </div>
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
                <div class="col-md-2 text-center mb-3">
                    <img src="{{ asset('images/avatars/avatar1.jpg') }}" class="avatar-img" alt="">
                    <p class="text-center">Hossam Khalil</p>
                    <a href="https://github.com/hossamkhalil01" target="_blank" class="icons-link"><i
                            class="fab fa-github fa-lg mt-2"></i></a>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <img src="{{ asset('images/avatars/avatar2.jpg') }}" class="avatar-img" alt="">
                    <p class="text-center">Leena Sherif</p>
                    <a href="https://github.com/leenasherif239" target="_blank" class="icons-link"><i
                            class="fab fa-github fa-lg mt-2"></i></a>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <img src="{{ asset('images/avatars/avatar3.jpg') }}" class="avatar-img" alt="">
                    <p class="text-center">Sarah Magdy</p>
                    <a href="https://github.com/SarahOuf" target="_blank" class="icons-link"><i
                            class="fab fa-github fa-lg mt-2"></i></a>
                </div>
                <div class="col-md-2 text-center mb-3">
                    <img src="{{ asset('images/avatars/avatar4.jpg') }}" class="avatar-img" alt="">
                    <p class="text-center">Mai Maher</p>
                    <a href="https://github.com/Maymaher" target="_blank" class="icons-link"><i
                            class="fab fa-github fa-lg mt-2"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
