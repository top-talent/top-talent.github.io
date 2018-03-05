@extends('layouts.master')

@section('title', 'Viewing Manual')

@section('content')

    <div class="row text-center">

        <h1>{{ $manual->name }}</h1>

        <div class="fa-6">
            {!! $manual->icon !!}
        </div>

        <hr>

        <div class="btn-group" role="group">
            <a class="btn btn-primary btn-lg"
               href="{{ route('maintenance.assets.manuals.download', [$asset->id, $manual->id]) }}"><i
                        class="fa fa-download"></i> Download</a>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('maintenance.assets.manuals.edit', [$asset->id, $manual->id]) }}"><i
                                    class="fa fa-edit"></i> Edit</a></li>
                    <li>
                        <a
                                data-message="Are you sure you want to delete this manual?"
                                data-method="DELETE"
                                data-token="{{ csrf_token() }}"
                                href="{{ route('maintenance.assets.manuals.destroy', [$asset->id, $manual->id]) }}"
                        >
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
