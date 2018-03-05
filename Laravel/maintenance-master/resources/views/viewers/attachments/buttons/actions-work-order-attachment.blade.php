@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ asset($attachment->file_path) }}">
            <i class="fa fa-search"></i> View / Download
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.attachments.destroy', [$workOrder->id, $attachment->id]) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this attachment?">
            <i class="fa fa-trash-o"></i> Delete
        </a>
    </li>
@overwrite
