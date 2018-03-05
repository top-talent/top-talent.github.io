{!! Form::select('recur_days[]', trans('recur.days'), (isset($days) ? $days : null), ['class'=>'form-control select2', 'placeholder'=>'Select Days', 'multiple'=>true]) !!}
