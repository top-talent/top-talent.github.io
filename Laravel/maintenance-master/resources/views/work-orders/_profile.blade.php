<table class="table">
    <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $workOrder->id }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $workOrder->created_at }}</td>
        </tr>
        @if($workOrder->status instanceof \App\Models\Status)
            <tr>
                <th>Status</th>
                <td>{!! $workOrder->status->getLabel() !!}</td>
            </tr>
        @endif
        @if($workOrder->priority instanceof \App\Models\Priority)
            <tr>
                <th>Priority</th>
                <td>{!! $workOrder->priority->getLabel() !!}</td>
            </tr>
        @endif
        <tr>
            <th>Created By</th>
            <td>{{ $workOrder->user->getRecipientName() }}</td>
        </tr>
        <tr>
            <th>Subject</th>
            <td>{{ $workOrder->subject }}</td>
        </tr>

        @if($workOrder->description)
            <tr>
                <th>Description</th>
                <td>{!! $workOrder->description !!}</td>
            </tr>
        @endif

        @if($workOrder->category)
            <tr>
                <th>Category</th>
                <td>{!! $workOrder->category->trail !!}</td>
            </tr>
        @endif

        @if($workOrder->location)
            <tr>
                <th>Location</th>
                <td>{!! $workOrder->location->trail !!}</td>
            </tr>
        @endif

        @if($workOrder->assets->count() > 0)
            <tr>
                <th>Assets Involved</th>
                <td>
                    @foreach($workOrder->assets as $asset)
                        {!! $asset->label !!}
                    @endforeach
                </td>
            </tr>
        @endif

        <tr>
            <th>Started At</th>
            <td>{!! $workOrder->getStartedAtLabel() !!}</td>
        </tr>
        <tr>
            <th>Completed At</th>
            <td>{!! $workOrder->getCompletedAtLabel() !!}</td>
        </tr>
    </tbody>
</table>
