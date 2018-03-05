<h2>Sessions & Hours</h2>

@if(isset($sessions) && count($sessions) > 0)

    {!!
        $sessions
            ->columns([
                'user' => 'Worker',
                'total_hours' => 'Total Hours'
            ])
            ->means('user', 'user.fullname')
            ->modify('total_hours', function($session) {
                return $session->viewer()->totalHours();
            })
            ->render()
    !!}

    <div class="row">

        <div class="col-md-12 text-center">
            <b>Worker Total Hours Spent: {{ $sessions->sum('total_hours') }}</b>
        </div>

    </div>

    <div class="clear-fix"></div>

    <a class="btn btn-sm btn-primary" href="{{ route('maintenance.work-orders.sessions.index', [$workOrder->id]) }}">All
        Sessions</a>

@else

    <h5>No workers have checked into this work order.</h5>

@endif
