<dl class="dl-horizontal">

    <dt>Name:</dt>
    <dd>{{ $group->name }}</dd>

    <p></p>

    <dt>Total Users:</dt>
    <dd>{{ $group->users->count() }}</dd>

    <p></p>

    <dt>Last Updated At:</dt>
    <dd>{{ $group->updated_at }}</dd>

    <p></p>

    <dt>Created At:</dt>
    <dd>{{ $group->created_at }}</dd>

    <p></p>

</dl>
