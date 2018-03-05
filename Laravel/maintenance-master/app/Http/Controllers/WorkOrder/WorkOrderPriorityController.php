<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOrder\PriorityRequest;
use App\Processors\WorkOrder\WorkOrderPriorityProcessor;

class WorkOrderPriorityController extends Controller
{
    /**
     * @var WorkOrderPriorityProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderPriorityProcessor $processor
     */
    public function __construct(WorkOrderPriorityProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays all priorities.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Displays the form for creating a priority.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Creates a new priority.
     *
     * @param PriorityRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PriorityRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created priority.');

            return redirect()->route('maintenance.work-orders.priorities.index');
        } else {
            flash()->error('Error!', 'There was an issue creating a priority. Please try again.');

            return redirect()->route('maintenance.work-orders.priorities.create');
        }
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
        return $this->processor->edit($id);
    }

    /**
     * Updates the specified priority.
     *
     * @param PriorityRequest $request
     * @param int|string      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PriorityRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully updated priority.');

            return redirect()->route('maintenance.work-orders.priorities.index');
        } else {
            flash()->error('Error!', 'There was an issue updating this priority. Please try again.');

            return redirect()->route('maintenance.work-orders.priorities.edit', [$id]);
        }
    }

    /**
     * Deletes the specified priority.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted priority.');

            return redirect()->route('maintenance.work-orders.priorities.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this priority. Please try again.');

            return redirect()->route('maintenance.work-orders.priorities.index');
        }
    }
}
