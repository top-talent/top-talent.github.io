@extends('layouts.pages.main.tabbed')

@section('title', "Viewing Item: $item->name")

@section('tab.head.content')
    <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
    <li><a href="#tab-variants" data-toggle="tab">Variants</a></li>
    <li><a href="#tab-calendar" data-toggle="tab">Calendar</a></li>
    <li><a href="#tab-notes" data-toggle="tab">Notes</a></li>
    <li><a href="#tab-history" data-toggle="tab">History</a></li>
@endsection

@section('tab.body.content')
    <div class="tab-pane active" id="tab-profile">
        <div class="row">
            <div class="col-md-12">
                @decorator('navbar', $navbarProfile)

                {!! $item->viewer()->profile() !!}
            </div>

            <div class="clear-fix"></div>

            <div class="col-md-12">

                @decorator('navbar', $navbarStocks)

                {!! $stocks !!}

            </div>
        </div>
    </div>

    <div class="tab-pane" id="tab-variants">

        @decorator('navbar', $navbarVariants)

        {!! $variants !!}
    </div>

    <div class="tab-pane" id="tab-calendar">
        {!! $item->viewer()->calendar() !!}
    </div>

    <div class="tab-pane" id="tab-notes">
        {!! $item->viewer()->btnAddNote() !!}

        <hr>

        {!! $item->viewer()->notes() !!}
    </div>

    <div class="tab-pane" id="tab-history">
        {!! $item->viewer()->history() !!}
    </div>
@endsection
