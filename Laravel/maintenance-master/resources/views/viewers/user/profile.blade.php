<dl class="dl-horizontal">

    <dt>ID</dt>
    <dd>{{ $user->id }}</dd>
    <p></p>

    <dt>Username</dt>
    <dd>{{ $user->username }}</dd>
    <p></p>

    <dt>Email</dt>
    <dd>{{ $user->email }}</dd>
    <p></p>

    <dt>Name</dt>
    <dd>{{ $user->full_name }}</dd>
    <p></p>

    <dt>Created At</dt>
    <dd>{{ $user->created_at }}</dd>
    <p></p>

    @if($user->last_login)
        <dt>Last Login</dt>
        <dd>{{ $user->last_login }}</dd>
        <p></p>
    @endif

    @if($user->permissions)
        <dt>Permissions</dt>
        <dd>
            <ul class="list-unstyled">
                @foreach($user->permissions as $name=>$value)
                    <li>{{ $name }} {{ $value }}</li>
                @endforeach
            </ul>
        </dd>
        <p></p>
    @endif

    @if($user->roles->count() > 0)
        <dt>Roles</dt>
        <dd>
            <ul class="list-unstyled">
                @foreach($user->roles as $role)
                    <li><a href="{{ route('maintenance.admin.roles.show', [$group->id]) }}"
                           class="label label-default">{{ $role->name }}</a></li>
                @endforeach
            </ul>
        </dd>
        <p></p>
        <br>
    @endif
</dl>
