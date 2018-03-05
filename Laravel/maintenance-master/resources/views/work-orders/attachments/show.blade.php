@extends('layouts.master')

@section('title', 'Viewing Attachment')

@section('content')

    <div class="text-center">

        <h1>{{ $attachment->name }}</h1>

        <div class="fa-6">
            {!! $attachment->icon !!}
        </div>

        <div class="btn-group" role="group">
            <a class="btn btn-primary btn-lg"
               href="{{ route('maintenance.work-orders.attachments.download', [$workOrder->id, $attachment->id]) }}"><i
                        class="fa fa-download"></i> Download</a>

            <div class="btn-group" role="group">
                <button type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('maintenance.work-orders.attachments.edit', [$workOrder->id, $attachment->id]) }}"><i
                                    class="fa fa-edit"></i> Edit</a></li>
                    <li>
                        <a
                                data-message="Are you sure you want to delete this attachment?"
                                data-method="DELETE"
                                data-token="{{ csrf_token() }}"
                                href="{{ route('maintenance.work-orders.attachments.destroy', [$workOrder->id, $attachment->id]) }}"
                        >
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

@endsection
