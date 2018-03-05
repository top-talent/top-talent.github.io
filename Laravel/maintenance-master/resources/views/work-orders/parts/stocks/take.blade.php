@extends('layouts.pages.main.panel')

@section('title', 'Take Parts')

@section('panel.head.content')
    Enter the Quantity Used
@endsection

@section('panel.body.content')
    <div class="col-md-4">
        <table class="table table-hover table-striped">
            <tbody>
            <tr>
                <th>Item</th>
                <td>{{ $item->name }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $stock->location->trail }}</td>
            </tr>
            <tr>
                <th>Current Stock</th>
                <td>{{ $stock->quantity }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <hr>

    <div class="col-md-6">
        {!! $form !!}
    </div>
@endsection
