@inject('htmlbuilder', 'html')

<div class="table-responsive">

    <table{!! $htmlbuilder->attributable($grid->attributes(), ['class' => 'table table-hover table-striped']) !!}>

        <thead>
        <tr>
            @foreach ($grid->columns() as $column)
                <th{!! $htmlbuilder->attributes($column->headers ?: []) !!}>
                    {!! $column->label !!}
                </th>
            @endforeach
        </tr>
        </thead>

        <tbody>
        @foreach ($grid->data() as $row)
            <tr{!! $htmlbuilder->attributes(call_user_func($grid->header(), $row) ?: []) !!}>
                @foreach ($grid->columns() as $column)
                    <td{!! $htmlbuilder->attributes(call_user_func($column->attributes, $row)) !!}>
                        {!! $column->getValue($row) !!}
                    </td>
                @endforeach
            </tr>
        @endforeach

        @if (! count($grid->data()) && $empty)
            <tr class="norecords">
                <td colspan="{!! count($grid->columns()) !!}">{!! $empty !!}</td>
            </tr>
        @endif
        </tbody>

    </table>

    <div class="text-center">
        {!! $pagination or '' !!}
    </div>

</div>
