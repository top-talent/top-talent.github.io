<div class="alert alert-info">
    The work request shown below will be used to create a work order. If you're sure you'd like to do this, click
    create.
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Subject</label>

    <div class="col-md-6">
        {!! Form::text('subject', (isset($workRequest) ? $workRequest->subject : null), ['class'=>'form-control', 'placeholder'=>'Enter Subject', 'disabled'=>true]) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Best Time</label>

    <div class="col-md-6">
        {!! Form::text('best_time', (isset($workRequest) ? $workRequest->best_time : null), ['class'=>'form-control', 'placeholder'=>'Enter Best Time', 'disabled'=>true]) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">Description</label>

    <div class="col-md-6">
        {!! Form::textarea('description', (isset($workRequest) ? htmlspecialchars($workRequest->description) : null), ['disabled'=>true]) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Create Work Order', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
