{!!
    Form::select(
        'routes[]',
        $allRoutes,
        (isset($routes) ? array_keys($routes) : []),
        array(
            'class' => 'form-control select2',
            'placeholder' => 'Enter Routes',
            'multiple' => true
        )
    )
!!}
