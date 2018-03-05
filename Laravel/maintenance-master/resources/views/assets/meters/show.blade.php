@extends('layouts.pages.main.tabbed')

@section('title', 'Viewing Asset Meter')

@section('tab.head.content')
    <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
    <li><a href="#tab-readings" data-toggle="tab">Readings</a></li>
@endsection

@section('tab.body.content')
    <div class="tab-pane active" id="tab-profile">

        {!! $meter->viewer()->btnEditForAsset($asset) !!}

        {!! $meter->viewer()->btnDeleteForAsset($asset) !!}

        <hr>

        <h3>Profile</h3>

        <div class="col-md-6">
            <table class="table">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $meter->name }}</td>
                </tr>
                <tr>
                    <th>Current Reading</th>
                    <td>{{ $meter->getLastReadingWithMetricAttribute() }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="tab-pane" id="tab-readings">
        @include('assets.meters.readings.grid.index', compact('asset, meter'))
    </div>

    <script>
        $(function () {
            $.datagrid('assets-meters-readings', '#assets-meters-readings-results', '#assets-meters-readings-pagination', '#assets-meters-readings-filters');
        });
    </script>
@endsection
