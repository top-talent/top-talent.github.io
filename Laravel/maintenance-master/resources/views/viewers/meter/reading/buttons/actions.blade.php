@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.assets.meters.readings.destroy', array($asset->id, $reading->meter->id, $reading->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this reading?">
            <i class="fa fa-trash-o"></i> Delete Reading
        </a>
    </li>
@overwrite
