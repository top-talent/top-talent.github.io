<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOrder\WorkOrderRequest;
use App\Processors\WorkOrder\WorkOrderProcessor;

class WorkOrderController extends Controller
{
    /**
     * @var WorkOrderProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderProcessor $processor
     */
    public function __construct(WorkOrderProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays work orders paginated.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return $this->processor->index();
    }

    /**
     * Displays the form to create a work order.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->processor->create();
    }

    /**
     * Creates a new work order.
     *
     * @param WorkOrderRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WorkOrderRequest $request)
    {
        if ($this->processor->store($request)) {
            flash()->success('Success!', 'Successfully created work order.');

            return redirect()->route('maintenance.work-orders.index');
        } else {
            flash()->error('Error!', 'There was an issue creating this work order. Please try again.');

            return redirect()->route('maintenance.work-orders.create');
        }
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
        return $this->processor->show($id);
    }

    /**
     * Displays the edit form for the specified work order.
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
     * Updates the specified work order.
     *
     * @param WorkOrderRequest $request
     * @param int|string       $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkOrderRequest $request, $id)
    {
        if ($this->processor->update($request, $id)) {
            flash()->success('Success!', 'Successfully edited work order.');

            return redirect()->route('maintenance.work-orders.show', [$id]);
        } else {
            flash()->error('Error!', 'There was an issue updating this work order. Please try again.');

            return redirect()->route('maintenance.work-orders.edit', [$id]);
        }
    }

    /**
     * Deletes a work order.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->processor->destroy($id)) {
            flash()->success('Success!', 'Successfully deleted work order.');

            return redirect()->route('maintenance.work-orders.index');
        } else {
            flash()->error('Error!', 'There was an issue deleting this work order. Please try again');

            return redirect()->route('maintenance.work-orders.index');
        }
    }
}
