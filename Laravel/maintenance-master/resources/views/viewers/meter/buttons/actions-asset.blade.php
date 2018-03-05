@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a data-toggle="modal" data-target="#update-reading-modal-{{ $meter->id }}">
            <i class="fa fa-refresh"></i>
            Update Reading
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="{{ route('maintenance.assets.meters.show', array($asset->id, $meter->id)) }}">
            <i class="fa fa-search"></i> View Meter Readings
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.meters.edit', array($asset->id, $meter->id)) }}">
            <i class="fa fa-edit"></i> Edit Meter
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.assets.meters.destroy', array($asset->id, $meter->id)) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this meter? All readings will be lost.">
            <i class="fa fa-trash-o"></i> Delete Meter
        </a>
    </li>
@overwrite

@section('dropdown.extra.bottom')

    @include('assets.modals.meters.update', array(
        'asset'=>$asset,
        'meter'=>$meter
    ))

@overwrite
