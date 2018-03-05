@extends('layouts.pages.main.tabbed')

@section('title', 'Viewing Asset')

@section('tab.head.content')
    <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
    <li><a href="#tab-history" data-toggle="tab">History</a></li>
    <li><a href="#tab-meters" data-toggle="tab">Meters & Readings</a></li>
    <li><a href="#tab-calendar" data-toggle="tab">Calendar</a></li>
@endsection

@section('tab.body.content')

    <div class="tab-pane active" id="tab-profile">

        <div class="row">

            <div class="col-md-12">

                {!! $asset->viewer()->btnEvents() !!}

                {!! $asset->viewer()->btnWorkOrders() !!}

                {!! $asset->viewer()->btnImages() !!}

                {!! $asset->viewer()->btnManuals() !!}

                {!! $asset->viewer()->btnEdit() !!}

                {!!$asset->viewer()->btnDelete() !!}

            </div>

            <div class="col-md-6">
                <h2>Profile</h2>

                {!! $asset->viewer()->profile() !!}
            </div>

            <div class="col-md-6">
                <h2>Images</h2>

                {!! $asset->viewer()->slideshow() !!}
            </div>
        </div>

    </div>

    <div class="tab-pane" id="tab-meters">

        <a href="{{ route('maintenance.assets.meters.create', [$asset->id]) }}" class="btn btn-app">
            <i class="fa fa-dashboard"></i> Add a Meter
        </a>

        <h2>Meters & Readings</h2>

        {!! $asset->viewer()->meters() !!}

    </div>

    <div class="tab-pane" id="tab-history">
        {!! $asset->viewer()->history() !!}
    </div>

    <div class="tab-pane" id="tab-calendar">

        <h2>Calendar</h2>

        {!! $asset->viewer()->calendar() !!}
    </div>

@endsection
