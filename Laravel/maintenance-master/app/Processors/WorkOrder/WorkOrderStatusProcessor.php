<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderStatusPresenter;
use App\Http\Requests\WorkOrder\StatusRequest;
use App\Jobs\WorkOrder\Status\Store;
use App\Jobs\WorkOrder\Status\Update;
use App\Models\Status;
use App\Processors\Processor;

class WorkOrderStatusProcessor extends Processor
{
    /**
     * @var Status
     */
    protected $status;

    /**
     * @var WorkOrderStatusPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param Status                   $status
     * @param WorkOrderStatusPresenter $presenter
     */
    public function __construct(Status $status, WorkOrderStatusPresenter $presenter)
    {
        $this->status = $status;
        $this->presenter = $presenter;
    }

    /**
     * Displays all statuses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $statuses = $this->presenter->table($this->status);

        $navbar = $this->presenter->navbar();

        return view('work-orders.statuses.index', compact('statuses', 'navbar'));
    }

    /**
     * Displays the form for creating a status.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form = $this->presenter->form($this->status);

        return view('work-orders.statuses.create', compact('form'));
    }

    /**
     * Creates a new status.
     *
     * @param StatusRequest $request
     *
     * @return bool
     */
    public function store(StatusRequest $request)
    {
        $status = $this->status->newInstance();

        return $this->dispatch(new Store($request, $status));
    }

    /**
     * Displays the form for editing the specified status.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $status = $this->status->findOrFail($id);

        $form = $this->presenter->form($status);

        return view('work-orders.statuses.edit', compact('form'));
    }

    /**
     * Updates the specified status.
     *
     * @param StatusRequest $request
     * @param int|string    $id
     *
     * @return bool
     */
    public function update(StatusRequest $request, $id)
    {
        $status = $this->status->findOrFail($id);

        return $this->dispatch(new Update($request, $status));
    }

    /**
     * Deletes the specified status.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function destroy($id)
    {
        $status = $this->status->findOrFail($id);

        return $status->delete();
    }
}
