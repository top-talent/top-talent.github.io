<?php

namespace App\Http\Controllers\WorkOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOrder\PartReturnRequest;
use App\Http\Requests\WorkOrder\PartTakeRequest;
use App\Processors\WorkOrder\WorkOrderPartStockProcessor;
use Stevebauman\Inventory\Exceptions\NotEnoughStockException;

class WorkOrderPartStockController extends Controller
{
    /**
     * @var WorkOrderPartStockProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param WorkOrderPartStockProcessor $processor
     */
    public function __construct(WorkOrderPartStockProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Display Inventory item stocks per location
     * available to transfer into the work order.
     *
     * @param int|string $workOrderId
     * @param int|string $itemId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId, $itemId)
    {
        return $this->processor->index($workOrderId, $itemId);
    }

    /**
     * Displays the form for taking inventory stock
     * and attaching it to the specified work order.
     *
     * @param int|string $workOrderId
     * @param int|string $itemId
     * @param int|string $stockId
     *
     * @return \Illuminate\View\View
     */
    public function getTake($workOrderId, $itemId, $stockId)
    {
        return $this->processor->getTake($workOrderId, $itemId, $stockId);
    }

    /**
     * Processes taking quantity from the stock and
     * inserting it into the work order.
     *
     * @param PartTakeRequest $request
     * @param int|string      $workOrderId
     * @param int|string      $itemId
     * @param int|string      $stockId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTake(PartTakeRequest $request, $workOrderId, $itemId, $stockId)
    {
        try {
            if ($this->processor->postTake($request, $workOrderId, $itemId, $stockId)) {
                flash()->success('Success!', 'Successfully added parts to work order.');

                return redirect()->route('maintenance.work-orders.parts.index', [$workOrderId]);
            } else {
                flash()->error('Error!', 'There was an issue adding parts to this work order. Please try again.');

                return redirect()->route('maintenance.work-orders.parts.stocks.take', [$workOrderId, $itemId, $stockId]);
            }
        } catch (NotEnoughStockException $e) {
            flash()->error('Not Enough Stock', "There isn't enough stock available to take the requested quantity.");

            return redirect()->route('maintenance.work-orders.parts.stocks.take', [$workOrderId, $itemId, $stockId]);
        }
    }

    /**
     * Displays the form for returning parts to the inventory.
     *
     * @param int|string $workOrderId
     * @param int|string $inventoryId
     * @param int|string $stockId
     *
     * @return \Illuminate\View\View
     */
    public function getPut($workOrderId, $inventoryId, $stockId)
    {
        return $this->processor->getPut($workOrderId, $inventoryId, $stockId);
    }

    /**
     * Processes returning parts back into the inventory.
     *
     * @param PartReturnRequest $request
     * @param int|string        $workOrderId
     * @param int|string        $inventoryId
     * @param int|string        $stockId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPut(PartReturnRequest $request, $workOrderId, $inventoryId, $stockId)
    {
        if ($this->processor->postPut($request, $workOrderId, $inventoryId, $stockId)) {
            flash()->success('Success!', 'Successfully returned parts to the inventory.');

            return redirect()->route('maintenance.work-orders.parts.index', [$workOrderId]);
        } else {
            flash()->error('Error!', 'There was an issue returning parts into the inventory. Please try again.');

            return redirect()->route('maintenance.work-orders.parts.stocks.put', [$workOrderId]);
        }
    }
}
