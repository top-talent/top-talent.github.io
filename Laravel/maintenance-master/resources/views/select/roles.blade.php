{!!
    Form::select(
        'groups[]',
        $allRoles,
        (isset($roles) ? $roles : []),
        [
            'class'=>'form-control select2',
            'placeholder' => 'Enter Groups',
            'multiple'=>true
        ]
    )
!!}
