<dl class="dl-horizontal">

    <dt>Title / Summary:</dt>
    <dd>{{ $apiObject->title }}</dd>

    <p></p>

    @if($apiObject->description)
        <dt>Description:</dt>
        <dd>{{ $apiObject->description }}</dd>

        <p></p>
    @endif

    @if($event->location)
        <dt>Location:</dt>
        <dd>{!! $event->location->trail !!}</dd>

        <p></p>
    @endif

    <dt>All Day:</dt>
    <dd>
        @if($apiObject->all_day)
            Yes
        @else
            No
        @endif
    </dd>

    <p></p>

    <dt>Starts:</dt>
    <dd>{{ $event->viewer()->startFormatted($apiObject) }}</dd>

    <p></p>

    <dt>Ends:</dt>
    <dd>{{ $event->viewer()->endFormatted($apiObject) }}</dd>

    <p></p>

    <dt>Recurring:</dt>
    <dd>
        @if($apiObject->rrule)
            Yes
        @else
            No
        @endif
    </dd>

    <p></p>

    <dt>Frequency:</dt>
    <dd>{{ $event->viewer()->recurFrequencyFormatted($apiObject) }}</dd>

    <p></p>

</dl>
