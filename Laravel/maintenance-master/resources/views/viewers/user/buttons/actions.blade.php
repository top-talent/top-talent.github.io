@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.admin.users.show', [$user->id]) }}">
            <i class="fa fa-search"></i> View User
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.users.edit', [$user->id]) }}">
            <i class="fa fa-edit"></i> Edit User
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.users.destroy', [$user->id]) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this user?">
            <i class="fa fa-trash-o"></i> Delete User
        </a>
    </li>
@overwrite
