<a data-target="#assign-workers-modal"
   data-toggle="modal"
   class="btn btn-app">
    <i class="fa fa-users"></i> Workers
</a>


<div class="modal fade" id="assign-workers-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Assign Workers to this Work Order</h4>
            </div>

            <div class="modal-body">

                <div id="workers-assigned-status"></div>

                <div id="assigned-workers">
                    @if($workOrder->hasWorkersAssigned())

                        <legend>Assigned Workers</legend>

                        {!!
                            $workOrder->assignments->columns([
                                'name' => 'Name',
                                'created_at' => 'Assigned',
                                'remove' => 'Remove',
                            ])
                            ->means('name', 'toUser.full_name')
                            ->modify('remove', function($assignment) {
                                return $assignment->viewer()->btnRemove();
                            })
                            ->render()
                        !!}

                    @else
                        <h5>There are currently no workers assigned to this work order.</h5>
                    @endif

                </div>

                <hr>

                <legend>Assign Workers</legend>

                {!!
                    Form::open([
                        'url' => route('maintenance.work-orders.assignments.store', [$workOrder->id]),
                        'class' => 'ajax-form-post',
                        'data-refresh-target' => '#assigned-workers',
                        'data-status-target' => '#workers-assigned-status',
                    ])
                !!}

                <label>Enter Names</label>

                @include('select.users')

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
