@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="{{ route('maintenance.inventory.show', array($item->id)) }}">
            <i class="fa fa-search"></i> View Item
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.inventory.edit', array($item->id)) }}">
            <i class="fa fa-edit"></i> Edit Item
        </a>
    </li>
    <li>
        <a
                href="{{ route('maintenance.inventory.destroy', array($item->id)) }}"
                data-method="delete"
                data-token="{{ csrf_token() }}"
                data-message="Are you sure you want to delete this item? It will be archived.">
            <i class="fa fa-trash-o"></i> Delete Item
        </a>
    </li>
@overwrite
