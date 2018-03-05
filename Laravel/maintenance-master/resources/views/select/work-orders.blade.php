{!!
    Form::select(
        'work_orders[]',
        $allWorkOrders,
        (isset($workOrders) ? $workOrders : null),
        array('class'=>'form-control select2', 'placeholder'=>'Search for work orders...', 'multiple'=>true))
!!}
