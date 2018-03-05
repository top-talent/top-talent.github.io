@if($group->permissions)

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Permission (Routes)</th>
            <th>Has Access</th>
        </tr>
        </thead>

        <tbody>
        @foreach($group->permissions as $permission=>$access)
            <tr>
                <td>{{ $permission }}</td>
                <td>
                    @if($access)
                        <span class="label label-success">Yes</span>
                    @else
                        <span class="label label-danger">No</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else

@endif
