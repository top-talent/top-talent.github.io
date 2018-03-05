<table class="table">
    <tbody>
    <tr>
        <th>Tag</th>
        <td>{{ $asset->tag }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ $asset->name }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{!! $asset->description !!}</td>
    </tr>
    <tr>
        <th>Vendor</th>
        <td>
            @if($asset->vendor)
                {{ $asset->vendor }}
            @else
                <em>None</em>
            @endif
        </td>
    </tr>
    <tr>
        <th>Make</th>
        <td>
            @if($asset->make)
                {{ $asset->make }}
            @else
                <em>None</em>
            @endif
        </td>
    </tr>
    <tr>
        <th>Model</th>
        <td>
            @if($asset->model)
                {{ $asset->model }}
            @else
                <em>None</em>
            @endif
        </td>
    </tr>
    <tr>
        <th>Serial</th>
        <td>
            @if($asset->serial)
                {{ $asset->serial }}
            @else
                <em>None</em>
            @endif
        </td>
    </tr>
    <tr>
        <th>Size</th>
        <td>
            @if($asset->size)
                {{ $asset->size }}
            @else
                <em>None</em>
            @endif
        </td>
    </tr>
    <tr>
        <th>Weight</th>
        <td>
            @if($asset->weight)
                {{ $asset->weight }}
            @else
                <em>None</em>
            @endif
        </td>
    </tr>
    <tr>
        <th>Added</th>
        <td>{{ $asset->created_at }}</td>
    </tr>
    <tr>
        <th>Category</th>
        <td>{!! $asset->category->trail !!}</td>
    </tr>
    <tr>
        <th>Condition</th>
        <td>{{ $asset->condition }}</td>
    </tr>
    @if($asset->user)
        <tr>
            <th>Added By</th>
            <td>{{ $asset->user->full_name }}</td>
        </tr>
    @endif
    @if($asset->acquired_at)
        <tr>
            <th>Acquired At</th>
            <td>{{ $asset->acquired_at }}</td>
        </tr>
    @endif
    @if($asset->end_of_life)
        <tr>
            <th>End of Life</th>
            <td>{{ $asset->end_of_life }}</td>
        </tr>
    @endif
    </tbody>
</table>
