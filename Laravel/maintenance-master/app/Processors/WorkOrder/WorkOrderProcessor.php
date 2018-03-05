<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderPresenter;
use App\Http\Requests\WorkOrder\WorkOrderRequest;
use App\Jobs\WorkOrder\Store;
use App\Jobs\WorkOrder\Update;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderProcessor extends Processor
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
     * Displays all work orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $workOrders = $this->presenter->table($this->workOrder);

        $navbar = $this->presenter->navbar();

        return view('work-orders.index', compact('workOrders', 'navbar'));
    }

    /**
     * Displays the form to create a work order.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->workOrder);

        return view('work-orders.create', compact('form'));
    }

    /**
     * Creates a new work order.
     *
     * @param WorkOrderRequest $request
     *
     * @return bool
     */
    public function store(WorkOrderRequest $request)
    {
        $workOrder = $this->workOrder->newInstance();

        return $this->dispatch(new Store($request, $workOrder));
    }

    /**
     * Displays the specified work order.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $workOrder = $this->workOrder->findOrFail($id);

        $sessions = $this->presenter->tableSessions($workOrder);

        $history = $this->presenter->tableHistory('work-orders', $workOrder->revisions());

        $navbar = $this->presenter->navbarShow($workOrder);

        $formComment = $this->presenter->formComment($workOrder, $workOrder->comments()->getRelated());

        return view('work-orders.show', compact('workOrder', 'sessions', 'history', 'navbar', 'formComment'));
    }

    /**
     * Displays the form for editing the specified work order.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $workOrder = $this->workOrder->findOrFail($id);

        $form = $this->presenter->form($workOrder);

        return view('work-orders.edit', compact('form'));
    }

    /**
     * Updates the specified work order.
     *
     * @param WorkOrderRequest $request
     * @param int|string       $id
     *
     * @return bool
     */
    public function update(WorkOrderRequest $request, $id)
    {
        $workOrder = $this->workOrder->findOrFail($id);

        return $this->dispatch(new Update($request, $workOrder));
    }

    /**
     * Deletes the specified work order.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $workOrder = $this->workOrder->findOrFail($id);

        return $workOrder->delete();
    }
}
