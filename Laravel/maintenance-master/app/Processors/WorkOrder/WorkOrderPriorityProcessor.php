<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderPriorityPresenter;
use App\Http\Requests\WorkOrder\PriorityRequest;
use App\Jobs\WorkOrder\Priority\Store;
use App\Jobs\WorkOrder\Priority\Update;
use App\Models\Priority;
use App\Processors\Processor;

class WorkOrderPriorityProcessor extends Processor
{
    /**
     * @var Priority
     */
    protected $priority;

    /**
     * @var WorkOrderPriorityPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param Priority                   $priority
     * @param WorkOrderPriorityPresenter $presenter
     */
    public function __construct(Priority $priority, WorkOrderPriorityPresenter $presenter)
    {
        $this->priority = $priority;
        $this->presenter = $presenter;
    }

    /**
     * Displays all priorities.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $priorities = $this->presenter->table($this->priority);

        $navbar = $this->presenter->navbar();

        return view('work-orders.priorities.index', compact('priorities', 'navbar'));
    }

    /**
     * Displays the form for creating a priority.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->priority);

        return view('work-orders.priorities.create', compact('form'));
    }

    /**
     * Creates a new priority.
     *
     * @param PriorityRequest $request
     *
     * @return bool
     */
    public function store(PriorityRequest $request)
    {
        $priority = $this->priority->newInstance();

        return $this->dispatch(new Store($request, $priority));
    }

    /**
     * Displays the form for editing the specified priority.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $priority = $this->priority->findOrFail($id);

        $form = $this->presenter->form($priority);

        return view('work-orders.priorities.edit', compact('form'));
    }

    /**
     * Updates the specified priority.
     *
     * @param PriorityRequest $request
     * @param int|string      $id
     *
     * @return bool
     */
    public function update(PriorityRequest $request, $id)
    {
        $priority = $this->priority->findOrFail($id);

        return $this->dispatch(new Update($request, $priority));
    }

    /**
     * Deletes the specified priority.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $priority = $this->priority->findOrFail($id);

        return $priority->delete();
    }
}
