@extends('layouts.blocks.chat')

@section('chat.body.attributes') id="updates-box" @overwrite

@section('chat.body.content')

    @if(count($workOrder->updates) > 0)
        @foreach($workOrder->updates as $update)
            {!! $update->viewer()->workOrder($workOrder) !!}
        @endforeach
    @else
        <h5>There are no updates to list.</h5>
    @endif

@overwrite

@section('chat.foot.content')

    {!!
        Form::open([
            'url'=>route('maintenance.work-orders.updates.store', [$workOrder->id]),
            'class'=>'ajax-form-post clear-form',
            'data-refresh-target'=>'#updates-box'
        ])
    !!}

    <div class="input-group">
        <input name="update_content" class="form-control" placeholder="Type an update..."/>

        <div class="input-group-btn">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
        </div>
    </div>

    {!! Form::close() !!}

@overwrite
