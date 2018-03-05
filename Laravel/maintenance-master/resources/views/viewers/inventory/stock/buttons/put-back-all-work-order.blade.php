<a class="btn btn-primary" data-toggle="modal"
   data-target="#put-back-items-modal-{{ $stock->item->id }}-{{ $stock->id }}">
    <i class="fa fa-reply"></i> All
</a>

<div class="modal fade" id="put-back-items-modal-{{ $stock->item->id }}-{{ $stock->id }}" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Put Back Item: {{ $stock->item->name }} Into Inventory?</h4>
            </div>

            {!!
                Form::open([
                    'url'=>route('maintenance.work-orders.parts.stocks.put-back', [$workOrder->id, $stock->item->id, $stock->id]),
                    'class'=>'ajax-form-post',
                    'data-status-target' => sprintf("#put-back-items-modal-status-%s-%s", $stock->item->id, $stock->id),
                    'data-refresh-target'=>'#parts-table'
                ])
            !!}

            <div class="modal-body">
                <div id="put-back-items-modal-status-{{ $stock->item->id }}-{{ $stock->id }}"></div>

                <p>
                    Are you sure you want to put back {{ $stock->pivot->quantity }}

                    @if($stock->item->metric) {{ $stock->item->metric->symbol }} @endif

                    of {{ $stock->item->name }}?
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Put Back</button>
            </div>

            {!! Form::close() !!}

        </div>

    </div>
</div>
