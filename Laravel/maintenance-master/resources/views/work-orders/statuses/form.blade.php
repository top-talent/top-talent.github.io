<legend class="margin-top-10">Status Information</legend>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
    <label class="col-sm-2 control-label">Name</label>

    <div class="col-md-4">
        {!! Form::text('name', (isset($status) ? $status->name : null), ['class'=>'form-control', 'placeholder'=>'ex. Awaiting Parts / Supplies']) !!}

        <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('color', ' has-error') }}">
    <label class="col-sm-2 control-label">Color</label>

    <div class="col-md-4">
        @include('select.color', [
            'color' => (isset($status) ? $status->color : null)
        ])

        <span class="label label-danger">{{ $errors->first('color', ':message') }}</span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>