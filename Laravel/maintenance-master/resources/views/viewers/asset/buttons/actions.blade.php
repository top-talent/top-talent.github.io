@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.assets.show', array($asset->id)) }}">
            <i class="fa fa-search"></i> View Asset
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.edit', array($asset->id)) }}">
            <i class="fa fa-edit"></i> Edit Asset
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.destroy', array($asset->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this asset? It will be archived.">
            <i class="fa fa-trash-o"></i> Delete Asset
        </a>
    </li>
@overwrite
