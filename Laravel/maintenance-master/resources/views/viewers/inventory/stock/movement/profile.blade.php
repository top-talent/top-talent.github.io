<dl class="dl-horizontal">

    <dt>ID:</dt>
    <dd>{{ $movement->id }}</dd>

    <p></p>

    <dt>Date:</dt>
    <dd>{{ $movement->created_at }}</dd>

    <p></p>

    <dt>User Responsible:</dt>
    <dd>{{ $movement->user->full_name }}</dd>

    <p></p>

    <dt>Before Quantity:</dt>
    <dd>{{ $movement->before }}</dd>

    <p></p>

    <dt>After Quantity:</dt>
    <dd>{{ $movement->after }}</dd>

    <p></p>

    <dt>Change:</dt>
    <dd>{{ $movement->change }}</dd>

    <p></p>

    <dt>Cost:</dt>
    <dd>{{ $movement->cost }}</dd>

    <p></p>

    <dt>Reason:</dt>
    <dd>{{ $movement->reason }}</dd>

    <p></p>

</dl>
