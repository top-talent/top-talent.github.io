<table class="table">
    <tbody>
    <tr>
        <th>Work Request ID</th>
        <td>{{ $workRequest->id }}</td>
    </tr>
    <tr>
        <th>Current Status</th>
        @if($workRequest->workOrder && $workRequest->workOrder->status instanceof \App\Models\Status)
            <td>{!! $workRequest->workOrder->status->getLabel() !!}</td>
        @else
            <em>None</em>
        @endif
    </tr>
    <tr>
        <th>Submitted By</th>
        <td>{{ $workRequest->user->full_name }}</td>
    </tr>
    <tr>
        <th>Best Time</th>
        <td>{{ $workRequest->best_time }}</td>
    </tr>
    <tr>
        <th>Subject</th>
        <td>{{ $workRequest->subject }}</td>
    </tr>
    <tr>
        <th>Details</th>
        <td>{!! $workRequest->description !!}</td>
    </tr>
    </tbody>
</table>
