@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.assets.calendars.show', array($asset->id, $calendar->id)) }}">
            <i class="fa fa-search"></i> View Calendar
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.calendars.edit', array($asset->id, $calendar->id)) }}">
            <i class="fa fa-edit"></i> Edit Calendar
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.calendars.destroy', array($asset->id, $calendar->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this calendar?">
            <i class="fa fa-trash-o"></i> Delete Calendar
        </a>
    </li>
@overwrite
