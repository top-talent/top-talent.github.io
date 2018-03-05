<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Processors\WorkOrder\WorkOrderAssignedProcessor;

class WorkOrderAssignedController extends Controller
{
    /**
     * @var WorkOrderAssignedProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderAssignedProcessor $processor
     */
    public function __construct(WorkOrderAssignedProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays the all assigned work orders for the current user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->processor->index();
    }
}
