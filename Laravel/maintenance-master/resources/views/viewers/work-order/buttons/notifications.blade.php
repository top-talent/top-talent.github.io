<a data-target="#work-order-notifications-modal"
   data-toggle="modal"
   class="btn btn-app">
    <i class="fa fa-warning"></i> Notifications
</a>

<div class="modal fade" id="work-order-notifications-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title">What would you like to be notified about?</h4>
            </div>
            <div class="modal-body">
                <div id="notificiation-response"></div>

                @if($workOrder->notify)
                    {!!
                        Form::open([
                           'url' => route('maintenance.work-orders.notifications.update', [$workOrder->id, $workOrder->notify->id]),
                           'class' => 'ajax-form-post',
                           'method' => 'PATCH',
                           'data-status-target' => '#notificiation-response',
                        ])
                    !!}
                @else
                    {!!
                        Form::open([
                           'url'=>route('maintenance.work-orders.notifications.store', [$workOrder->id]),
                           'class' => 'ajax-form-post',
                           'data-status-target' => '#notificiation-response',
                        ])
                    !!}
                @endif


                <div class="form-group">
                    <label class="col-md-6 control-label">Status Changes</label>

                    <div class="col-md-6">
                        {!! Form::checkbox('status', '1', ($workOrder->notify ? $workOrder->notify->status : null)) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Priority Changes</label>

                    <div class="col-md-6">
                        {!! Form::checkbox('priority', '1', ($workOrder->notify ? $workOrder->notify->priority : null)) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Parts Added</label>

                    <div class="col-md-6">
                        {!! Form::checkbox('parts', '1', ($workOrder->notify ? $workOrder->notify->parts : null)) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Customer Updates are Added</label>

                    <div class="col-md-6">
                        {!! Form::checkbox('customer_updates', '1', ($workOrder->notify ? $workOrder->notify->customer_updates : null)) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Technician Updates are Added</label>

                    <div class="col-md-6">
                        {!! Form::checkbox('technician_updates', '1', ($workOrder->notify ? $workOrder->notify->technician_updates : null)) !!}
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <label class="col-md-6 control-label">Completion Report is Created</label>

                    <div class="col-md-6">
                        {!! Form::checkbox('completion_report', '1', ($workOrder->notify ? $workOrder->notify->completion_report : null)) !!}
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
