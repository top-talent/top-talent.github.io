@extends('layouts.pages.main.tabbed')

@section('tab.head.content')
    <li class="active"><a href="#tab_profile" data-toggle="tab">Profile</a></li>
@endsection

@section('tab.body.content')

    <div class="tab-pane active" id="tab_profile">

        {!! $movement->viewer()->btnRollback($item, $stock) !!}

        <hr>

        {!! $movement->viewer()->profile() !!}
    </div>

@endsection
