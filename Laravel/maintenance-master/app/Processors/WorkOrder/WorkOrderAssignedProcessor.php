<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderPresenter;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderAssignedProcessor extends Processor
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var WorkOrderPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkOrder          $workOrder
     * @param WorkOrderPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, WorkOrderPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->presenter = $presenter;
    }

    /**
     * Displays the current users assigned work orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $workOrders = $this->presenter->tableAssigned($this->workOrder);

        $navbar = $this->presenter->navbar();

        return view('work-orders.assigned.index', compact('workOrders', 'navbar'));
    }
}
