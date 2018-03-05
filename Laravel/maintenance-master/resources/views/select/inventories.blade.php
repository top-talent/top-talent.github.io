{!! Form::select(
            'inventories[]',
            $allInventories,
            (isset($inventories) ? $inventories : null),
            array('class'=>'form-control select2', 'placeholder'=>'Search inventory...', 'multiple'=>true))
!!}
