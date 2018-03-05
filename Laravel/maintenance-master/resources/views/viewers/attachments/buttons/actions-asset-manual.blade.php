@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ asset($manual->file_path) }}">
            <i class="fa fa-search"></i> View Manual
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.manuals.destroy', [$asset->id, $manual->id]) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this manual?">
            <i class="fa fa-trash-o"></i> Delete Manual
        </a>
    </li>
@overwrite
