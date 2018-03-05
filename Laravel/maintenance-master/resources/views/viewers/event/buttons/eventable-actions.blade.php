@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ action(currentControllerAction('show'), array($eventable->id, $event->id)) }}">
            <i class="fa fa-search"></i> View Event
        </a>
    </li>
    <li>
        <a href="{{ action(currentControllerAction('edit'), array($eventable->id, $event->id)) }}">
            <i class="fa fa-edit"></i> Edit Event
        </a>
    </li>
    <li>
        <a href="{{ action(currentControllerAction('destroy'), array($eventable->id, $event->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this event?">
            <i class="fa fa-trash-o"></i> Delete Event
        </a>
    </li>
@overwrite
