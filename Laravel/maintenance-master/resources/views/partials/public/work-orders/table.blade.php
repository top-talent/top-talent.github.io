<table class="table table-striped">
    <thead>
    <th>Status</th>
    <th>Subject</th>
    <th>Submitted</th>
    <th>Action</th>
    </thead>
    <tbody>
    @foreach($workOrders as $workOrder)
        <tr>
            <td>{{ $workOrder->status->getLabel() }}</td>
            <td>{{ $workOrder->subject }}</td>
            <td>{{ $workOrder->created_at }}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                        Action
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('maintenance.work-requests.show', array($workOrder->id)) }}">
                                <i class="fa fa-search"></i> View
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('maintenance.work-requests.edit', array($workOrder->id)) }}">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('maintenance.work-requests.destroy', array($workOrder->id)) }}"
                               data-method="delete"
                               data-token="{{ csrf_token() }}"
                               data-message="Are you sure you want to delete this work request?">
                                <i class="fa fa-trash-o"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="text-center">{!! $workOrders->appends(Input::except('page'))->render() !!}</div>
