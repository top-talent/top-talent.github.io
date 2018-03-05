@if(isset($record))
    <h2>History</h2>

    @if($record->revisions->count() > 0)

        <table class="table table-striped">
            <thead>
            <tr>
                <th>User Responsible</th>
                <th>Changed</th>
                <th>From</th>
                <th>To</th>
                <th>On</th>
            </tr>
            </thead>
            <tbody>
            @foreach($record->revisions as $record)
                <tr>
                    <td>{{ ($record->getUserResponsible() ? $record->getUserResponsible()->fullname : '<em>Deleted</em>') }}</td>
                    <td>{{ $record->getColumnName() }}</td>
                    <td>
                        @if(is_null($record->getOldValue()))
                            <em>None</em>
                        @else
                            {!! $record->getOldValue() !!}
                        @endif

                    </td>
                    <td>{!! $record->getNewValue() !!}</td>
                    <td>{{ $record->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else

        <h5>There is no history to display.</h5>

    @endif
@endif
