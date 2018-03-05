<legend>Item Information</legend>

<div class="form-group{{ $errors->first('category_name', ' has-error') }}{{ $errors->first('category_id', ' has-error') }}">
    <label class="col-sm-2 control-label">Category</label>

    <div class="col-md-4">
        @include('select.inventory-category', [
            'category_name' => (isset($item) ? $item->category->name : null),
            'category_id'=> (isset($item) ? $item->category->id : null)
        ])

        <span class="label label-danger">{{ $errors->first('category_id', ':message') }}</span>
        <span class="label label-danger">{{ $errors->first('category', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('metric', ' has-error') }}">
    <label class="col-sm-2 control-label">Metric</label>

    <div class="col-md-4">
        @include('select.metric', [
            'metric' => (isset($item) ? ($item->metric ?: $item->metric->id) : null)
        ])

        <span class="label label-danger">{{ $errors->first('metric', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('name', ' has-error') }}">
    <label class="col-sm-2 control-label">Name</label>

    <div class="col-md-4">
        {!! Form::text('name', (isset($item) ? $item->name : null), ['class'=>'form-control', 'placeholder'=>'Name']) !!}

        <span class="label label-danger">{{ $errors->first('name', ':message') }}</span>
    </div>
</div>

<div class="form-group{{ $errors->first('description', ' has-error') }}">
    <label class="col-sm-2 control-label">Description</label>

    <div class="col-md-4">
        {!! Form::textarea('description', (isset($item) ? htmlspecialchars($item->description) : null), ['class'=>'form-control', 'placeholder'=>'Description']) !!}

        <span class="label label-danger">{{ $errors->first('description', ':message') }}</span>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
</div>
