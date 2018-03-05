@if($workOrder->request)

    {!! $workOrder->request->viewer()->profile() !!}

@else

    <h5>There is no work request attached to this work order.</h5>

@endif
