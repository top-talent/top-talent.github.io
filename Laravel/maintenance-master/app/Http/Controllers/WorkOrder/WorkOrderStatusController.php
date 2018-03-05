<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOrder\StatusRequest;
use App\Processors\WorkOrder\WorkOrderStatusProcessor;

class WorkOrderStatusController extends Controller
{
    /**
     * @var WorkOrderStatusProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderStatusProcessor $processor
     */
    public function __construct(WorkOrderStatusProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays all of the work order statuses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Displays the form for creating a new work order status.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Creates a new work order status.
     *
     * @param StatusRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StatusRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created status.');

            return redirect()->route('maintenance.work-orders.statuses.index');
        } else {
            flash()->error('Error!', 'There was an issue creating this status. Please try again.');

            return redirect()->route('maintenance.work-orders.statuses.create');
        }
    }

    /**
     * Displays the form for editing a work order status.
     *
     * @param int|string $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return $this->processor->edit($id);
    }

    /**
     * Updates the specified work order status.
     *
     * @param StatusRequest $request
     * @param int|string    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StatusRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully updated status.');

            return redirect()->route('maintenance.work-orders.statuses.index');
        } else {
            flash()->error('Error!', 'There was an issue updating this status. Please try again.');

            return redirect()->route('maintenance.work-orders.statuses.edit', [$id]);
        }
    }

    /**
     * Deletes the specified work order status.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted status.');

            return redirect()->route('maintenance.work-orders.statuses.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this status. Please try again.');

            return redirect()->route('maintenance.work-orders.statuses.index', [$id]);
        }
    }
}
