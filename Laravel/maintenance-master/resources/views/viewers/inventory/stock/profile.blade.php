<dl class="dl-horizontal">

    <dt>Created At:</dt>
    <dd>{{ $stock->created_at }}</dd>

    <p></p>

    @if($stock->user)
        <dt>Created By:</dt>
        <dd>{{ $stock->user->full_name }}</dd>

        <p></p>
    @endif

    <dt>Current Stock:</dt>
    <dd>{{ $stock->quantity_metric }}</dd>

    <p></p>

    <dt>Last Movement:</dt>
    <dd>{!! $stock->last_movement !!}</dd>

    <p></p>

    <dt>Last Movement By:</dt>
    <dd>{{ $stock->last_movement_by }}</dd>

    <p></p>

</dl>
