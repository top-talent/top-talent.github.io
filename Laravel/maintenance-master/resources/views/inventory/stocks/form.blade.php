<div class="form-group{{ $errors->first('location_id', ' has-error') }}{{ $errors->first('location', ' has-error') }}">
    <label class="col-sm-2 control-label">Location</label>

    <div class="col-md-4">
        @include('select.location', [
            'location_name' => (isset($stock) ? $stock->location->name : null),
            'location_id' => (isset($stock) ? $stock->location->id : null)
        ])

        <span class="label label-danger">{{ $errors->first('location', ':message') }}</span>
        <span class="label label-danger">{{ $errors->first('location_id', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('quantity', ' has-error') }}">
    <label class="col-sm-2 control-label">Quantity</label>

    <div class="col-md-4">
        {!! Form::text('quantity', (isset($stock) ? $stock->quantity : null), ['class'=>'form-control', 'placeholder'=>'ex. 45']) !!}

        <span class="label label-danger">{{ $errors->first('quantity', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('reason', ' has-error') }}">
    <label class="col-sm-2 control-label">Reason</label>

    <div class="col-md-4">
        {!! Form::text('reason', null, ['class'=>'form-control', 'placeholder'=>'ex. Stock Update']) !!}

        <span class="label label-danger">{{ $errors->first('reason', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('cost', ' has-error') }}">
    <label class="col-sm-2 control-label">Cost</label>

    <div class="col-md-4">
        {!! Form::text('cost', null, ['class'=>'form-control', 'placeholder'=>'ex. 15.00']) !!}

        <span class="label label-danger">{{ $errors->first('cost', ':message') }}</span>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>