<div class="form-group{{ $errors->first('subject', ' has-error') }}">
    <label class="col-sm-2 control-label">Subject</label>

    <div class="col-md-6">
        {!! Form::text('subject', (isset($workRequest) ? $workRequest->subject : null), ['class'=>'form-control', 'placeholder'=>'Enter Subject']) !!}

        <span class="label label-danger">{{ $errors->first('subject', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('best_time', ' has-error') }}">
    <label class="col-sm-2 control-label">Best Time</label>

    <div class="col-md-6">
        {!! Form::text('best_time', (isset($workRequest) ? $workRequest->best_time : null), ['class'=>'form-control', 'placeholder'=>'Enter Best Time']) !!}

        <span class="label label-danger">{{ $errors->first('best_time', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('description', ' has-error') }}">
    <label class="col-sm-2 control-label">Description</label>

    <div class="col-md-6">
        {!! Form::textarea('description', (isset($workRequest) ? htmlspecialchars($workRequest->description) : null)) !!}

        <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
