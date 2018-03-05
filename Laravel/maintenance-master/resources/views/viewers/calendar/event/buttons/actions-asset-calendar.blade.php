@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')

    <li>
        <a href="{{ route('maintenance.assets.calendars.events.show', array($asset->id, $calendar->id, $event->id)) }}">
            <i class="fa fa-search"></i> View Event
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.calendars.events.edit', array($asset->id, $calendar->id, $event->id)) }}">
            <i class="fa fa-edit"></i> Edit Event
        </a>
    </li>
    <li>
        <a
                href="{{ route('maintenance.assets.calendars.events.destroy', array($asset->id, $calendar->id, $event->id)) }}"
                data-method="delete"
                data-token="{{ csrf_token() }}"
                data-title="Are you sure?"
                data-message="Are you sure you want to delete this event? Deleting this event will also remove all recurrences."
        >
            <i class="fa fa-trash-o"></i> Delete Event
        </a>
    </li>

@overwrite
