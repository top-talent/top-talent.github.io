<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Processors\WorkOrder\WorkOrderSessionProcessor;

class WorkOrderSessionController extends Controller
{
    /**
     * @var WorkOrderSessionProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderSessionProcessor $processor
     */
    public function __construct(WorkOrderSessionProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays all the sessions for the specified work order.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId)
    {
        return $this->processor->index($workOrderId);
    }

    /**
     * Starts a maintenance workers session on a work order.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function start($workOrderId)
    {
        if ($this->processor->start($workOrderId)) {
            flash()->success('Success!', "Successfully started your session. Don't forget to check out!");

            return redirect()->route('maintenance.work-orders.show', [$workOrderId]);
        } else {
            flash()->error('Error!', 'There was an issue creating your session. Please try again.');

            return redirect()->route('maintenance.work-orders.show', [$workOrderId]);
        }
    }

    /**
     * Ends a maintenance workers session on a work order.
     *
     * @param int|string $workOrderId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function end($workOrderId)
    {
        if ($this->processor->end($workOrderId)) {
            flash()->success('Success!', 'Successfully ended your session. Your hours have been logged.');

            return redirect()->route('maintenance.work-orders.show', [$workOrderId]);
        } else {
            flash()->error('Error!', 'There was an issue ending your session. Please try again.');

            return redirect()->route('maintenance.work-orders.show', [$workOrderId]);
        }
    }
}
