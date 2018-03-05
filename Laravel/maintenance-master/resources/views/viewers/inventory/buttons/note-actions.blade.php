@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.inventory.notes.edit', array($item->id, $note->id)) }}">
            <i class="fa fa-edit"></i> Edit Note
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.inventory.notes.destroy', array($item->id, $note->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this note?">
            <i class="fa fa-trash-o"></i> Delete Note
        </a>
    </li>
@overwrite
