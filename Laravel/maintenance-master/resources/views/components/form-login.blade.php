@inject('formbuilder', 'form')
@inject('htmlbuilder', 'html')

{!! $formbuilder->open(array_merge($grid->attributes(), ['class' => 'form-horizontal'])) !!}

@if ($token)
    {!! $formbuilder->token() !!}
@endif

@foreach ($grid->hiddens() as $hidden)
    {!! $hidden !!}
@endforeach

@include('components.fieldsets')

<fieldset>

    <div class="row">
        {{-- Fixed row issue on Bootstrap 3 --}}
    </div>

    <div class="row">

        <button type="submit" class="btn btn-lg btn-block btn-primary">
            {!! $submit !!}
        </button>

    </div>

</fieldset>

{!! $formbuilder->close() !!}
