@extends('layouts.master')

@section('title', 'Welcome')

@section('container')

    <style>
        .jumbotron-welcome {
            position: relative;
            background: #000 url('{{ asset('img/jumbotron-bg.png') }}') center center;
            width: 100%;
            height: 100%;
            min-height: 100vh;
            background-size: cover;
            overflow: hidden;
            margin-bottom: 0;
        }

        .jumbotron p {
            font-size: 15px;
        }

        .jumbotron .container h1 {
            font-size: 60px;
            padding: 0 150px;
            margin-top: -10px;
            margin-bottom: 80px;
        }

        .navbar {
            margin-bottom: 0;
        }
    </style>

    <div class="jumbotron jumbotron-welcome">

        <div class="container">

            <div class="text-center text-white">

                <h1 class="hidden-xs">Welcome.</h1>

                <h2 class="visible-xs">Welcome.</h2>

            </div>

        </div>

    </div>

@endsection

@section('footer')
@endsection
