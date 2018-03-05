<a class="btn btn-primary" data-toggle="modal"
   data-target="#put-back-some-items-modal-{{ $stock->item->id }}-{{ $stock->id }}">
    <i class="fa fa-reply"></i> Some
</a>

<div class="modal fade" id="put-back-some-items-modal-{{ $stock->item->id }}-{{ $stock->id }}" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">

                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>

                </button>

                <h4 class="modal-title" id="myModalLabel">
                    Put Back Some of Item: {{ $stock->item->name }} Into Inventory?
                </h4>

            </div>

            {!!
                Form::open([
                    'url' => route('maintenance.work-orders.parts.stocks.put-back-some', [$workOrder->id, $stock->item->id, $stock->id]),
                    'class' => 'ajax-form-post',
                    'data-status-target' => sprintf("#put-back-some-items-modal-status-%s-%s", $stock->item->id, $stock->id),
                    'data-refresh-target' => '#parts-table'
                ])
            !!}

            <div class="modal-body">
                <div id="put-back-some-items-modal-status-{{ $stock->item->id }}-{{ $stock->id }}"></div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Quantity</label>

                    <div class="input-group">
                        {!! Form::text('quantity', null, ['class'=>'form-control', 'placeholder'=>'ex. 45']) !!}

                        @if($stock->item->metric)
                            <span class="input-group-addon">{{ $stock->item->metric->symbol }}</span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Put Back</button>
            </div>

            {!! Form::close() !!}

        </div>

    </div>
</div>
