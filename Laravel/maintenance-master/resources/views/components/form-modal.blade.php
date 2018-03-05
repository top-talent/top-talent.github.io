@inject('formbuilder', 'form')
@inject('htmlbuilder', 'html')

<div class="modal-body">

    {!! $formbuilder->open($grid->attributes()) !!}

    @if ($token)
        {!! $formbuilder->token() !!}
    @endif

    @foreach ($grid->hiddens() as $hidden)
        {!! $hidden !!}
    @endforeach

    @include('components.fieldsets')

</div>

<div class="modal-footer">

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

    <button type="submit" class="btn btn-primary">
        {!! $submit !!}
    </button>

    {!! $formbuilder->close() !!}

</div>
