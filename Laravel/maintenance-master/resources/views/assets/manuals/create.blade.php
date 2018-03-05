@extends('layouts.pages.main.panel')

@section('title', 'Add Asset Manuals')

@section('panel.head.content')
    Add Asset Manuals
@endsection

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route('maintenance.assets.manuals.store', [$asset->id]),
            'files' => true,
        ])
    !!}

    <div class="form-group">
        {!! Form::file('files[]', ['multiple' => true]) !!}

        <span class="label label-danger">{{ $errors->first('files', ':message') }}</span>
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class'=>'btn btn-success']) !!}
    </div>
@endsection
