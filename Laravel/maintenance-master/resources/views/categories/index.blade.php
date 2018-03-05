@extends('layouts.pages.main.panel')

@section('title', str_plural($resource))

@section('panel.head.content')
    <div class="btn-toolbar">
        <a href="{{ route($routes['create']) }}" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            New {{ $resource }}
        </a>

        <a id="edit-category"
           class="btn btn-warning"
           style="display:none;" href="">
            <i class="fa fa-pencil"></i>
            Edit {{ $resource }}
        </a>

        <a id="create-sub-category"
           class="btn btn-success"
           style="display:none;" href="">
            <i class="fa fa-plus"></i>
            New Sub-{{ $resource }}
        </a>

        <div class="pull-right">
            <a
                    href="{{ route($routes['destroy'], [null]) }}"
                    data-method="delete"
                    data-token="{{ csrf_token() }}"
                    data-message="
                        Are you sure you want to delete this {{ $resource }}? This can have a large cascade effect.
                        Anything attached to this {{ $resource }} will be deleted, as well as {{ str_plural($resource) }} below the selected {{ $resource }}.
                        You should move or rename the {{ $resource }} instead of deleting it if possible.
                    "
                    id="delete-sub-category"
                    class="btn btn-danger"
                    style="display:none;"
            >
                <i class="fa fa-trash-o"></i>
                Delete {{ $resource }}
            </a>
        </div>
    </div>
@endsection

@section('panel.body.content')

    <div class="row">
        <div class="col-md-12">
            {{-- Dynamic getJson method for allowing mutliple nested set resources to use this view --}}
            <div class="tree" data-token="{{ csrf_token() }}" data-src="{{ route($routes['grid'])  }}"
                 data-move="{{ route($routes['move']) }}"></div>
        </div>
    </div>
@endsection
