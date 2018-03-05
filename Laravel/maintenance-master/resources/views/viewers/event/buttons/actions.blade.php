@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ action(currentControllerAction('show'), array($event->id)) }}">
            <i class="fa fa-search"></i> View Event
        </a>
    </li>
    <li>
        <a href="{{ action(currentControllerAction('edit'), array($event->id)) }}">
            <i class="fa fa-edit"></i> Edit Event
        </a>
    </li>
    <li>
        <a href="{{ action(currentControllerAction('destroy'), array($event->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this event?">
            <i class="fa fa-trash-o"></i> Delete Event
        </a>
    </li>
@overwrite
