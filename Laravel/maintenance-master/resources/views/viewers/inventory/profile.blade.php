<table class="table">
    <tbody>
    @if($item->user)
        <tr>
            <th>Created By</th>
            <td>{{ $item->user->full_name }}</td>
        </tr>
    @endif
    <tr>
        <th>Added</th>
        <td>{{ $item->created_at }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ $item->name }}</td>
    </tr>
    @if($item->category)
        <tr>
            <th>Category</th>
            <td>{!! $item->category->trail !!}</td>
        </tr>
    @endif
    @if($item->hasSku())
        <tr>
            <th>SKU</th>
            <td>{{ $item->getSku() }}</td>
        </tr>
    @endif
    <tr>
        <th>Metric</th>
        <td>{{ $item->metric->name }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{!! $item->description !!}</td>
    </tr>
    </tbody>
</table>
