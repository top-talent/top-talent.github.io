{!! Form::select(
            'status',
            $statuses,
            (isset($status) ? $status : null),
            array('class'=>'form-control select2', 'placeholder'=>'ex. Repaired / Awaiting for Parts')
        )
!!}
