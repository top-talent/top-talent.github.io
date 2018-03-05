@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.admin.groups.show', array($group->id)) }}">
            <i class="fa fa-search"></i> View Group
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.groups.edit', array($group->id)) }}">
            <i class="fa fa-edit"></i> Edit Group
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.groups.destroy', array($group->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this group? Deleting this group will mean that all members will
           lose their permissions that they received from this group.">
            <i class="fa fa-trash-o"></i> Delete Group
        </a>
    </li>
@overwrite
