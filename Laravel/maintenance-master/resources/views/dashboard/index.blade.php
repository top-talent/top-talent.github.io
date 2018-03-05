@extends('layouts.master')

@section('title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">

                    {!! HTML::script('js/calendar/full.js') !!}

                    <div
                            id="calendar"
                            data-event-url="{{ route('maintenance.api.v1.events.between') }}"
                            class="fc fc-ltr"
                    >

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
