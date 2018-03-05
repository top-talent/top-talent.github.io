{!!
    Form::select(
        'assets[]',
        $allAssets,
        (isset($assets) ? $assets : null),
        ['class' => 'form-control select2', 'placeholder' => 'Search for assets...', 'multiple' => true]
    )
!!}
