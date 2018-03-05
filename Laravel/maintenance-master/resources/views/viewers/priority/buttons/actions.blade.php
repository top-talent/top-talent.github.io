@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.work-orders.priorities.edit', array($priority->id)) }}">
            <i class="fa fa-edit"></i> Edit Priority
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.priorities.destroy', array($priority->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this priority?">
            <i class="fa fa-trash-o"></i> Delete Priority
        </a>
    </li>
@overwrite
