@extends('layouts.pages.main.panel')

@section('title', 'Viewing Metric')

@section('panel.head.content')
    Viewing Metric
@endsection

@section('panel.body.content')

    <div class="col-md-4">
        <table class="table">
            <tbody>
            @if($metric->user)
                <tr>
                    <th>Created By</th>
                    <td>{{ $metric->user->full_name }}</td>
                </tr>
            @endif
            <tr>
                <th>Name</th>
                <td>{{ $metric->name }}</td>
            </tr>
            <tr>
                <th>Symbol</th>
                <td>{{ $metric->symbol }}</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
