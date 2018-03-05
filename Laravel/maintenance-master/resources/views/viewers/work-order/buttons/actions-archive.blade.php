@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.admin.archive.work-orders.restore', [$workOrder->id]) }}"
           data-method="post"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to restore this work order?">
            <i class="fa fa-refresh"></i> Restore
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="{{ route('maintenance.admin.archive.work-orders.show', [$workOrder->id]) }}">
            <i class="fa fa-search"></i> View
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.admin.archive.work-orders.destroy', [$workOrder->id]) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to permanently delete this work order? You will not be able to recover this data.">
            <i class="fa fa-trash-o"></i> Delete (Permanent)
        </a>
    </li>
@overwrite
