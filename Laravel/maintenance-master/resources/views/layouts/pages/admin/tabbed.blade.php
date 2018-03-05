@extends('layouts.admin')

@section('content')

    @yield('tab.extra.top')

    <div class="nav-tabs-custom">

        @section('tab.head')

            <ul class="nav nav-tabs">

                @yield('tab.head.content')

            </ul>

        @show

        @section('tab.body')

            <div class="tab-content">

                @yield('tab.body.content')

            </div>

        @show

    </div>

    @yield('tab.extra.bottom')

@endsection
