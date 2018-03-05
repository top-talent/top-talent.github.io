@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.metrics.edit', array($metric->id)) }}">
            <i class="fa fa-edit"></i> Edit Metric
        </a>
    </li>
    <li>
        <a
                href="{{ route('maintenance.metrics.destroy', array($metric->id)) }}"
                data-method="delete"
                data-token="{{ csrf_token() }}"
                data-message="Are you sure you want to delete this metric?
        Anything that was attached to this metric will need to be set to a new metric after deletion.">
            <i class="fa fa-trash-o"></i> Delete Metric
        </a>
    </li>

@overwrite
