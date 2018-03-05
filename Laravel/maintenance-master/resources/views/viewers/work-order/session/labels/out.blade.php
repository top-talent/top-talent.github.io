@if(is_null($out))
    <span class="label label-success">Currently Open</span>
@else
    {{ $out }}
@endif
