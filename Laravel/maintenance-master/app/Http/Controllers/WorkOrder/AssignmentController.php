<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller as BaseController;
use App\Services\WorkOrder\AssignmentService;
use App\Services\WorkOrder\WorkOrderService;
use App\Validators\AssignmentValidator;

class AssignmentController extends BaseController
{
    /**
     * @var AssignmentService
     */
    protected $assignment;

    /**
     * @var WorkOrderService
     */
    protected $workOrder;

    /**
     * @var AssignmentValidator
     */
    protected $assignmentValidator;

    /**
     * Constructor.
     *
     * @param AssignmentService   $assignment
     * @param WorkOrderService    $workOrder
     * @param AssignmentValidator $assignmentValidator
     */
    public function __construct(AssignmentService $assignment, WorkOrderService $workOrder, AssignmentValidator $assignmentValidator)
    {
        $this->assignment = $assignment;
        $this->workOrder = $workOrder;
        $this->assignmentValidator = $assignmentValidator;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $workOrder_id
     */
    public function index($workOrder_id)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $workOrder_id
     */
    public function create($workOrder_id)
    {
    }

    /**
     * Assigns workers to the specified work order ID.
     *
     * @param string|int $workOrder_id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store($workOrder_id)
    {
        if ($this->assignmentValidator->passes()) {
            $workOrder = $this->workOrder->find($workOrder_id);

            $data = $this->inputAll();
            $data['work_order_id'] = $workOrder->id;

            $records = $this->assignment->setInput($data)->create();

            if ($records) {
                $this->message = 'Successfully assigned worker(s)';
                $this->messageType = 'success';
                $this->redirect = route('maintenance.work-orders.show', [$workOrder->id]);
            } else {
                $this->message = 'There was an error trying to assign workers to this work order. Please try again.';
                $this->messageType = 'danger';
                $this->redirect = route('maintenance.work-orders.show', [$workOrder->id]);
            }
        } else {
            $this->errors = $this->assignmentValidator->getErrors();
            $this->redirect = route('maintenance.work-orders.show', [$workOrder_id]);
        }

        return $this->response();
    }

    /**
     * Removes the specified assignent from the specified work order.
     *
     * @param string|int $workOrder_id
     * @param string|int $assignment_id
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy($workOrder_id, $assignment_id)
    {
        if ($this->assignment->destroy($assignment_id)) {
            $this->message = 'Successfully removed worker from this work order.';
            $this->messageType = 'success';
            $this->redirect = route('maintenance.work-orders.show', [$workOrder_id]);
        } else {
            $this->message = 'There was an error trying to remove this worker from this work order. Please try again later.';
            $this->messageType = 'danger';
            $this->redirect = route('maintenance.work-orders.show', [$workOrder_id]);
        }

        return $this->response();
    }
}
