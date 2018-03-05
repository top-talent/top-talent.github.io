{!!
    Form::select(
        'users[]',
        $allUsers,
        (isset($users) ? $users : '0'),
        ['class' => 'form-control select2', 'placeholder' => 'Enter Users', 'multiple' => true]
    )
!!}
