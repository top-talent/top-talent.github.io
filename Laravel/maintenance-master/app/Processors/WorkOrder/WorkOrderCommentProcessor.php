<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderCommentPresenter;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderCommentProcessor extends Processor
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkOrder                 $workOrder
     * @param WorkOrderCommentPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, WorkOrderCommentPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->presenter = $presenter;
    }
}
