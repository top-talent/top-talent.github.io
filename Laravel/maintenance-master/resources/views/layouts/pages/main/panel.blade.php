@extends('layouts.master')

@section('content')

    @yield('panel.extra.top')

    <div class="panel panel-default">

        @section('panel.head')

            <div class="panel-heading">

                @yield('panel.head.content')

            </div>

        @show

        @section('panel.body')

            <div id="resource-paginate" class="panel-body">

                <div class="col-md-12">
                    @yield('panel.body.content')
                </div>

            </div>

        @show

    </div>

    @yield('panel.extra.bottom')

@endsection
