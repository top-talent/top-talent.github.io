<div class="form-group{{ $errors->first('tag', ' has-error') }}">
    <label class="col-sm-2 control-label">Tag Number</label>

    <div class="col-sm-10 col-md-4">
        {!! Form::text('tag', (isset($asset) ? $asset->tag : null), ['class'=>'form-control', 'placeholder'=>'ex. 100010']) !!}

        <span class="label label-danger">{{ $errors->first('tag', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
    <label class="col-sm-2 control-label">Name</label>

    <div class="col-md-4">
        {!! Form::text('name', (isset($asset) ? $asset->name : null), ['class'=>'form-control', 'placeholder'=>'ex. Ford F150']) !!}

        <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('description', ' has-error') }}">
    <label class="col-sm-2 control-label">Description</label>

    <div class="col-md-4">
        {!! Form::textarea('description', (isset($asset) ? htmlspecialchars($asset->description) : null)) !!}

        <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('condition', ' has-error') }}">
    <label class="col-sm-2 control-label">Condition</label>

    <div class="col-md-4">
        {!! Form::select('condition', trans('assets.conditions'), (isset($asset) ? $asset->condition_number : null), ['class'=>'form-control select2']) !!}

        <span class="label label-danger">{{ $errors->first('condition', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('category', ' has-error') }}{{ $errors->first('category_id', ' has-error') }}">
    <label class="col-sm-2 control-label">Category</label>

    <div class="col-md-4">
        @include('select.asset-category', [
            'category_name'=>(isset($asset) ? $asset->category->name : null),
            'category_id'=> (isset($asset) ? $asset->category->id : null)
        ])

        <span class="label label-danger">{{ $errors->first('category', ':message') }}</span>
        <span class="label label-danger">{{ $errors->first('category_id', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('location', ' has-error') }}{{ $errors->first('location_id', ' has-error') }}">
    <label class="col-sm-2 control-label">Location</label>

    <div class="col-md-4">
        @include('select.location', [
            'location_name'=> (isset($asset) ? $asset->location->name : null),
            'location_id' => (isset($asset) ? $asset->location->id : null)
        ])

        <span class="label label-danger">{{ $errors->first('location', ':message') }}</span>
        <span class="label label-danger">{{ $errors->first('location_id', ':message') }}</span>
    </div>
</div>

<legend class="margin-top-10">Other Information</legend>

<div class="form-group{{ $errors->first('vendor', ' has-error') }}">
    <label class="col-sm-2 control-label">Vendor</label>

    <div class="col-md-4">
        {!! Form::text('vendor', (isset($asset) ? $asset->vendor : null), ['class'=>'form-control', 'placeholder'=>'ex. Ford']) !!}

        <span class="label label-danger">{{ $errors->first('vendor', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('make', ' has-error') }}">
    <label class="col-sm-2 control-label">Make</label>

    <div class="col-md-4">
        {!! Form::text('make', (isset($asset) ? $asset->make : null), ['class'=>'form-control', 'placeholder'=>'ex. F']) !!}

        <span class="label label-danger">{{ $errors->first('make', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('model', ' has-error') }}">
    <label class="col-sm-2 control-label">Model</label>

    <div class="col-md-4">
        {!! Form::text('model', (isset($asset) ? $asset->model : null), ['class'=>'form-control', 'placeholder'=>'ex. 150']) !!}

        <span class="label label-danger">{{ $errors->first('model', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('serial', ' has-error') }}">
    <label class="col-sm-2 control-label">Serial</label>

    <div class="col-md-4">
        {!! Form::text('serial', (isset($asset) ? $asset->serial : null), ['class'=>'form-control', 'placeholder'=>'ex. 153423-13432432-2342423']) !!}

        <span class="label label-danger">{{ $errors->first('serial', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('size', ' has-error') }}">
    <label class="col-sm-2 control-label">Size</label>

    <div class="col-md-4">
        {!! Form::text('size', (isset($asset) ? $asset->size : null), ['class'=>'form-control', 'placeholder'=>'ex. 1905 x 2463']) !!}

        <span class="label label-danger">{{ $errors->first('size', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('weight', ' has-error') }}">
    <label class="col-sm-2 control-label">Weight</label>

    <div class="col-md-4">
        {!! Form::text('weight', (isset($asset) ? $asset->weight : null), ['class'=>'form-control', 'placeholder'=>'ex. 1 ton']) !!}

        <span class="label label-danger">{{ $errors->first('weight', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('acquired_at', ' has-error') }}">
    <label class="col-sm-2 control-label">Acquisition Date</label>

    <div class="col-md-4">
        {!! Form::text('acquired_at', (isset($asset) ? $asset->acquired_at : null), ['class'=>'pickadate form-control', 'placeholder'=>'Click to Select Date']) !!}

        <span class="label label-danger">{{ $errors->first('acquired_at', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('end_of_life', ' has-error') }}">
    <label class="col-sm-2 control-label">End of Life Date</label>

    <div class="col-md-4">
        {!! Form::text('end_of_life', (isset($asset) ? $asset->end_of_life : null), ['class'=>'pickadate form-control', 'placeholder'=>'Click to Select Date']) !!}

        <span class="label label-danger">{{ $errors->first('end_of_life', ':message') }}</span>
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 col-md-offset-2">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
