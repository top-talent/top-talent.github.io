<div class="form-group{{ $errors->first('name', ' has-error') }}">
    <label class="col-sm-2 control-label">Name</label>

    <div class="col-md-4">
        {!! Form::text('name', (isset($image) ? $image->name : null), ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}

        <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
    </div>
</div>

<div class="form-group">

    <div class="col-md-offset-2 col-md-6">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>

</div>
