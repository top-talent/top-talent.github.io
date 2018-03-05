@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.work-orders.show', array($workOrder->id)) }}">
            <i class="fa fa-search"></i> View Work Order
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.edit', array($workOrder->id)) }}">
            <i class="fa fa-edit"></i> Edit Work Order
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.destroy', array($workOrder->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this work order? It will be archived.">
            <i class="fa fa-trash-o"></i> Delete Work Order
        </a>
    </li>
@overwrite
