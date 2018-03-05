@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.work-orders.statuses.edit', array($status->id)) }}">
            <i class="fa fa-edit"></i> Edit Status
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.statuses.destroy', array($status->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this status?">
            <i class="fa fa-trash-o"></i> Delete Status
        </a>
    </li>
@overwrite
