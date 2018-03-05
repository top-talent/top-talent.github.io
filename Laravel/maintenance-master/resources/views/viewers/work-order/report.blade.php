@if($workOrder->report)

    <table class="table">
        <tbody>
        <tr>
            <th>Created By</th>
            <td>{{ $workOrder->report->user->full_name }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $workOrder->report->created_at}}</td>
        </tr>
        <tr>
            <th>Report</th>
            <td>{!! $workOrder->report->description !!}</td>
        </tr>
        </tbody>
    </table>

@else

    <h5>No report has been created for this work order.</h5>

@endif
