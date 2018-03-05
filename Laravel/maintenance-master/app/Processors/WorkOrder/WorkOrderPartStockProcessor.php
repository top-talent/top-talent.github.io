<?php

namespace App\Processors\WorkOrder;

use App\Http\Presenters\WorkOrder\WorkOrderPartStockPresenter;
use App\Http\Requests\WorkOrder\PartReturnRequest;
use App\Http\Requests\WorkOrder\PartTakeRequest;
use App\Jobs\WorkOrder\Part\Put;
use App\Jobs\WorkOrder\Part\Take;
use App\Models\Inventory;
use App\Models\WorkOrder;
use App\Processors\Processor;

class WorkOrderPartStockProcessor extends Processor
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
     * Constructor.
     *
     * @param WorkOrder                   $workOrder
     * @param Inventory                   $inventory
     * @param WorkOrderPartStockPresenter $presenter
     */
    public function __construct(WorkOrder $workOrder, Inventory $inventory, WorkOrderPartStockPresenter $presenter)
    {
        $this->workOrder = $workOrder;
        $this->inventory = $inventory;
        $this->presenter = $presenter;
    }

    /**
     * Displays all stocks and variants available for selection.
     *
     * @param int|string $workOrderId
     * @param int|string $itemId
     *
     * @return \Illuminate\View\View
     */
    public function index($workOrderId, $itemId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $item = $this->inventory->findOrFail($itemId);

        $stocks = $this->presenter->table($workOrder, $item);

        $variants = $this->presenter->tableVariants($workOrder, $item);

        return view('work-orders.parts.stocks.index', compact('stocks', 'variants'));
    }

    /**
     * Displays the form for taking inventory for the specified work order.
     *
     * @param int|string $workOrderId
     * @param int|string $itemId
     * @param int|string $stockId
     *
     * @return \Illuminate\View\View
     */
    public function getTake($workOrderId, $itemId, $stockId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $item = $this->inventory->findOrFail($itemId);

        $stock = $item->stocks()->findOrFail($stockId);

        $form = $this->presenter->formTake($workOrder, $item, $stock);

        return view('work-orders.parts.stocks.take', compact('workOrder', 'item', 'stock', 'form'));
    }

    /**
     * Processes taking inventory for the specified work order.
     *
     * @param PartTakeRequest $request
     * @param int|string      $workOrderId
     * @param int|string      $itemId
     * @param int|string      $stockId
     *
     * @throws \Stevebauman\Inventory\Exceptions\InvalidQuantityException
     * @throws \Stevebauman\Inventory\Exceptions\NotEnoughStockException
     *
     * @return bool
     */
    public function postTake(PartTakeRequest $request, $workOrderId, $itemId, $stockId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $item = $this->inventory->findOrFail($itemId);

        $stock = $item->stocks()->findOrFail($stockId);

        return $this->dispatch(new Take($request, $workOrder, $stock));
    }

    /**
     * Displays the form for putting inventory from the
     * work order back into the specified stock.
     *
     * @param int|string $workOrderId
     * @param int|string $itemId
     * @param int|string $stockId
     *
     * @return \Illuminate\View\View
     */
    public function getPut($workOrderId, $itemId, $stockId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        $item = $this->inventory->findOrFail($itemId);

        $stock = $workOrder->parts()->findOrFail($stockId);

        $form = $this->presenter->formPut($workOrder, $item, $stock);

        return view('work-orders.parts.stocks.put', compact('workOrder', 'item', 'stock', 'form'));
    }

    /**
     * Processes returning stock from the work order back into the specified inventory.
     *
     * @param PartReturnRequest $request
     * @param int|string        $workOrderId
     * @param int|string        $itemId
     * @param int|string        $stockId
     *
     * @throws \Stevebauman\Inventory\Exceptions\InvalidQuantityException
     *
     * @return bool
     */
    public function postPut(PartReturnRequest $request, $workOrderId, $itemId, $stockId)
    {
        $workOrder = $this->workOrder->findOrFail($workOrderId);

        // Even though the inventory item isn't necessary here, we'll
        // find it anyway so we can check for the requests validity
        // and ensure the specified stock is actually attached to
        // the one requested.
        $item = $this->inventory->findOrFail($itemId);

        $item->stocks()->findOrFail($stockId);

        $stock = $workOrder->parts()->findOrFail($stockId);

        return $this->dispatch(new Put($request, $workOrder, $stock));
    }
}
