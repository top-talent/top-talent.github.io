@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.admin.logs.show', array($entry->id)) }}">
            <i class="fa fa-search"></i> View Entry
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.logs.mark-read', array($entry->id)) }}"
           data-method="post"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to mark this entry as read? You will need to clear the cache to recover it.">
            <i class="fa fa-eye"></i> Mark Read
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.logs.destroy', array($entry->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this log entry? This cannot be recovered">
            <i class="fa fa-trash-o"></i> Delete Entry
        </a>
    </li>
@overwrite
