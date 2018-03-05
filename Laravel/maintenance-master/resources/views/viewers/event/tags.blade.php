<dl class="dl-horizontal">

    <dt>Tagged To:</dt>
    <dd>
        @if(count($event->assets) > 0)

            @foreach($event->assets as $asset)

                {!! $asset->viewer()->btnEventTag() !!}

            @endforeach

        @endif

        @if(count($event->inventories) > 0)

            @foreach($event->inventories as $item)

                {!! $item->viewer()->btnEventTag() !!}

            @endforeach

        @endif

        @if(count($event->workOrders) > 0)

            @foreach($event->workOrders as $workOrder)

                {!! $workOrder->viewer()->btnEventTag() !!}

            @endforeach

        @endif
    </dd>

    <br>
</dl>
