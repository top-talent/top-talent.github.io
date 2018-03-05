<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderSessionPresenter;
use App\Jobs\WorkOrder\Session\End;
use App\Jobs\WorkOrder\Session\Start;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderSessionProcessor extends Processor
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var WorkOrderSessionPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkOrder                 $workOrder
     * @param WorkOrderSessionPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, WorkOrderSessionPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->presenter = $presenter;
    }

    /**
     * Displays all sessions for the specified work order.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $sessions = $this->presenter->table($workOrder);

        $navbar = $this->presenter->navbar();

        return view('work-orders.sessions.index', compact('sessions', 'navbar'));
    }

    /**
     * Starts the current users session for the specified work order.
     *
     * @param int|string $workOrderId
     *
     * @return mixed
     */
    public function start($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        return $this->dispatch(new Start($workOrder));
    }

    /**
     * Ends the current users session for the specified work order.
     *
     * @param int|string $workOrderId
     *
     * @return mixed
     */
    public function end($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        return $this->dispatch(new End($workOrder));
    }
}
