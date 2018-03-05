<dl class="dl-horizontal">

    <dt>Name</dt>
    <dd>{{ $calendar->name }}</dd>

    <p></p>

    @if($calendar->description)
        <dt>Description</dt>
        <dd>{!! $calendar->description !!}</dd>

        <p></p>
    @endif

</dl>
