{!! Form::select('color', Config::get('maintenance.colors'), (isset($color) ? $color : null), ['class'=>'form-control select2-color']) !!}
