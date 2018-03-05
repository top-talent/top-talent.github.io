<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderPartPresenter;
use App\Models\Inventory;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderPartProcessor extends Processor
{
    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var Inventory
     */
    protected $inventory;

    /**
     * @var WorkOrderPartPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param WorkOrder              $workOrder
     * @param Inventory              $inventory
     * @param WorkOrderPartPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, Inventory $inventory, WorkOrderPartPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->inventory = $inventory;
        $this->presenter = $presenter;
    }

    /**
     * Displays the specified work orders parts and inventory.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $parts = $this->presenter->table($workOrder);

        $inventory = $this->presenter->tableInventory($workOrder, $this->inventory);

        $navbarParts = $this->presenter->navbarParts($workOrder);

        $navbarInventory = $this->presenter->navbarInventory();

        return view('work-orders.parts.index', compact('parts', 'inventory', 'workOrder', 'navbarParts', 'navbarInventory'));
    }
}
