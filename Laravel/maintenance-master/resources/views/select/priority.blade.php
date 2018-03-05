{!! Form::select(
        'priority',
        $priorities,
        (isset($priority) ? $priority : null),
        array('class'=>'form-control select2', 'placeholder'=>'ex. Low / Lowest')
    )
!!}
