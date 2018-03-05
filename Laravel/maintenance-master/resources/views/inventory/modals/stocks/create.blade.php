<div class="modal fade" id="create-stock-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add new Stock Location</h4>
            </div>

            {!!
                Form::open([
                    'url' => route('maintenance.inventory.stocks.store', [$item->id]),
                    'class' => 'form-horizontal ajax-form-post clear-form',
                    'data-status-target' => '#stock-location-status',
                    'data-refresh-target' => '#inventory-stocks-table',
                ])
            !!}

            <div class="modal-body">

                <div id="stock-location-status"></div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Location</label>

                    <div class="col-md-10">
                        @include('select.location')
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Quantity</label>

                    <div class="col-md-10">
                        <div class="input-group">
                            {!! Form::text('quantity', null, ['class'=>'form-control', 'placeholder'=>'ex. 45']) !!}

                            @if($item->metric)
                                <span class="input-group-addon">{{ $item->metric->symbol }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Cost</label>

                    <div class="col-md-10">

                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {!! Form::text('cost', null, ['class'=>'form-control', 'placeholder'=>'ex. 15.00']) !!}
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>

            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
