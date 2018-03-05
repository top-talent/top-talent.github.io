{!!
    Form::open([
       'url' => route('maintenance.work-orders.assignments.destroy', [$assignment->workOrder->id, $assignment->id]),
       'method' => 'DELETE',
       'class' => 'ajax-form-post',
       'data-refresh-target' => '#assigned-workers',
       'data-status-target' => '#workers-assigned-status'
   ])
!!}

<button
        type="submit"
        class="btn btn-sm btn-primary confirm"
        data-confirm-message="{{ sprintf('Are you sure you want to remove <b>%s</b> from this work order?', $assignment->toUser->full_name) }}"
><i class="fa fa-trash-o"></i> Remove
</button>

{!! Form::close() !!}
