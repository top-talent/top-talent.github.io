@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.admin.archive.assets.restore', array($asset->id)) }}"
           data-method="POST"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to restore this asset?">
            <i class="fa fa-refresh"></i> Restore
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="{{ route('maintenance.admin.archive.assets.show', array($asset->id)) }}">
            <i class="fa fa-search"></i> View
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.archive.assets.destroy', array($asset->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to permanently delete this asset? You will not be able to recover this data.">
            <i class="fa fa-trash-o"></i> Delete (Permanent)
        </a>
    </li>
@overwrite
