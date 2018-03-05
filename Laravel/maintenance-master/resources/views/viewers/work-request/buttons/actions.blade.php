@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.work-requests.show', array($workRequest->id)) }}">
            <i class="fa fa-search"></i> View Work Request
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-requests.edit', array($workRequest->id)) }}">
            <i class="fa fa-edit"></i> Edit Work Request
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-requests.destroy', array($workRequest->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this work request? It will be archived.">
            <i class="fa fa-trash-o"></i> Delete Work Request
        </a>
    </li>
    <li class="divider"></li>
    @if($workRequest->workOrder)
        <li>
            <a href="{{ route('maintenance.work-orders.show', array($workRequest->workOrder->id)) }}">
                <i class="fa fa-search"></i> View Work Order
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('maintenance.work-orders.requests.create', array($workRequest->id)) }}">
                <i class="fa fa-plus"></i> Create Work Order
            </a>
        </li>
    @endif
@overwrite
