<legend>Event Report</legend>

<div id="event-report">

    @if($event->report)

        <dl class="dl-horizontal">

            <dt>Created By:</dt>
            <dd>{{ $event->report->user->fullname }}</dd>

            <p></p>

            <dt>Created On:</dt>
            <dd>{{ $event->report->created_at }}</dd>

            <p></p>

            <dt>Report:</dt>
            <dd>
                {!! $event->report->description !!}
            </dd>

        </dl>

    @else
        {!!
            Form::open([
                'url' => route('maintenance.events.report.store', [$event->id]),
                'class' => 'form-horizontal'
            ])
        !!}

        <div class="form-group{{ $errors->first('description', ' has-error') }}">
            <label class="col-sm-2 control-label">Description / Details</label>

            <div class="col-md-6">
                {!! Form::textarea('description', null, ['class'=>'form-control', 'style'=>'min-width:100%']) !!}

                <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    @endif

</div>
