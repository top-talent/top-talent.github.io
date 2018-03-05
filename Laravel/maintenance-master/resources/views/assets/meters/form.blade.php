<div class="form-group{{ $errors->first('name', ' has-error') }}">
    <label class="col-sm-2 control-label">Name</label>

    <div class="col-md-4">
        {!! Form::text('name', (isset($meter) ? $meter->name : null), ['class'=>'form-control', 'placeholder'=>'Enter a Name']) !!}

        <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('reading', ' has-error') }}">
    <label class="col-sm-2 control-label">Reading</label>

    <div class="col-md-4">
        {!! Form::text('reading', (isset($lastReading) ? $lastReading->reading : null), ['class'=>'form-control', 'placeholder'=>'Enter the Current Reading']) !!}

        <span class="label label-danger">{{ $errors->first('reading', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('comment', ' has-error') }}">
    <label class="col-sm-2 control-label">Comment</label>

    <div class="col-md-4">
        {!! Form::text('comment', null, ['class'=>'form-control', 'placeholder'=> 'Enter a Comment']) !!}

        <span class="label label-danger">{{ $errors->first('comment', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('metric', ' has-error') }}">
    <label class="col-sm-2 control-label">Metric</label>

    <div class="col-md-4">
        @include('select.metric', [
            'metric' => (isset($meter) ? $meter->metric->id : null),
        ])

        <span class="label label-danger">{{ $errors->first('metric', ':message') }}</span>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-2">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
