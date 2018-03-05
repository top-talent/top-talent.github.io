@foreach ($grid->fieldsets() as $fieldset)

    <fieldset{!! $htmlbuilder->attributes($fieldset->attributes ?: []) !!}>

        @if ($fieldset->name)
            <legend>{!! $fieldset->name or '' !!}</legend>
        @endif

        @foreach ($fieldset->controls() as $control)
            <div class="form-group{!! $errors->has($control->id) ? ' has-error' : '' !!}">
                {!! $formbuilder->label($control->name, $control->label, ['class' => 'control-label']) !!}

                <div class="nine columns">

                    <div>{!! $control->getField($grid->data(), $control, []) !!}</div>

                    @if ($control->inlineHelp)
                        <span class="help-inline">{!! $control->inlineHelp !!}</span>
                    @endif

                    @if ($control->help)
                        <p class="help-block">{!! $control->help !!}</p>
                    @endif

                    {!! $errors->first($control->id, $format) !!}

                </div>

            </div>

        @endforeach

    </fieldset>

@endforeach
