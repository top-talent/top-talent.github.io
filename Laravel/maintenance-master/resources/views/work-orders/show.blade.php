@extends('layouts.pages.main.tabbed')

@section('title', "Viewing Work Order")

@section('tab.extra.top')
    @decorator('navbar', $navbar)
@endsection

@section('tab.head.content')
    <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
    <li><a href="#tab-sessions" data-toggle="tab">Sessions</a></li>
    <li><a href="#tab-calendar" data-toggle="tab">Calendar</a></li>
    <li><a href="#tab-history" data-toggle="tab">History</a></li>
@endsection

@section('tab.body.content')

    <div class="tab-pane active" id="tab-profile">

        <div class="row">

            <div class="col-md-6">
                <h3>Work Order</h3>

                @include('work-orders._profile')
            </div>

            <div class="col-md-6">
                <h3>Maintenance Request</h3>

                {!! $workOrder->viewer()->workRequest() !!}

                <hr>

                <h3>Completion Report</h3>

                {!! $workOrder->viewer()->report() !!}
            </div>

        </div>
    </div>

    <div class="tab-pane" id="tab-sessions">

        <h2>Sessions</h2>

        {!! $sessions !!}

    </div>

    <div class="tab-pane" id="tab-calendar">

        {!! $workOrder->viewer()->calendar() !!}

    </div>

    <div class="tab-pane" id="tab-history">

        {!! $history !!}

    </div>

@endsection

@section('tab.extra.bottom')
    <hr>

    <h3>Comments</h3>

    @foreach($workOrder->comments as $comment)
        @decorator('comment', $comment, [
            'edit'      => route('work-orders.comments.edit', [$comment->pivot->issue_id, $comment->getKey()]),
            'destroy'   => route('work-orders.comments.destroy', [$comment->pivot->issue_id, $comment->getKey()]),
        ])
    @endforeach

    <hr>

    {!! $formComment !!}

@endsection
