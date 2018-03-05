@if($group->users->count() > 0)
    {!!
        $group->users->columns([
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'name' => 'Name',
            'action' => 'Action',
        ])
        ->means('name', 'full_name')
        ->modify('action', function($user) {
            return $user->viewer()->btnActions();
        })
        ->render()
    !!}
@else
    <h5>There are no users apart of this group.</h5>
@endif
