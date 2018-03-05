@extends('layouts.master')

@section('title', 'Login')

@section('title.header')
@endsection

@section('content')

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <h2 class="text-center">
            Login
        </h2>

        <p class="text-muted text-center">
            Please enter your credentials.
        </p>

        {!! $form !!}

        <p class="text-center">
            <br>
            <a href="#">Forgot Your Password?</a>
        </p>

    </div>

    <div class="col-md-3"></div>

@endsection
