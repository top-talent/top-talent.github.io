<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Inventory\InventoryStockRequest;
use App\Processors\Inventory\InventoryStockProcessor;

class StockController extends BaseController
{
    /**
     * @var InventoryStockProcessor
     */
    protected $processor;

    /**
     * Constructor.
     *
     * @param InventoryStockProcessor $processor
     */
    public function __construct(InventoryStockProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Displays all inventory stock entries.
     *
     * @param int|string $itemId
     *
     * @return \Illuminate\View\View
     */
    public function index($itemId)
    {
        return $this->processor->index($itemId);
    }

    /**
     * Displays the form for creating a new stock entry for the inventory.
     *
     * @param int|string $itemId
     *
     * @return \Illuminate\View\View
     */
    public function create($itemId)
    {
        return $this->processor->create($itemId);
    }

    /**
     * Create a new stock entry for the specified inventory item.
     *
     * @param InventoryStockRequest $request
     * @param int|string            $itemId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InventoryStockRequest $request, $itemId)
    {
        if ($this->processor->store($request, $itemId)) {
            flash()->success('Success!', 'Successfully created stock.');

            return redirect()->route('maintenance.inventory.stocks.index', [$itemId]);
        } else {
            flash()->error('Error!', 'There was an issue creating an inventory stock. Please try again.');

            return redirect()->route('maintenance.inventory.stocks.create', [$itemId]);
        }
    }

    /**
     * Displays the specified stock entry for the specified inventory.
     *
     * @param int|string $itemId
     * @param int|string $stockId
     *
     * @return \Illuminate\View\View
     */
    public function show($itemId, $stockId)
    {
        return $this->processor->show($itemId, $stockId);
    }

    /**
     * Displays the edit form for the specified stock for the specified inventory.
     *
     * @param int|string $itemId
     * @param int|string $stockId
     *
     * @return \Illuminate\View\View
     */
    public function edit($itemId, $stockId)
    {
        return $this->processor->edit($itemId, $stockId);
    }

    /**
     * Updates the specified stock for the specified inventory.
     *
     * @param InventoryStockRequest $request
     * @param int|string            $itemId
     * @param int|string            $stockId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InventoryStockRequest $request, $itemId, $stockId)
    {
        if ($this->processor->update($request, $itemId, $stockId)) {
            flash()->success('Success!', 'Successfully updated stock.');

            return redirect()->route('maintenance.inventory.stocks.show', [$itemId, $stockId]);
        } else {
            flash()->error('Error!', 'There was an issue updating this stock. Please try again.');

            return redirect()->route('maintenance.inventory.stocks.update', [$itemId, $stockId]);
        }
    }

    /**
     * Removes the specified stock from the specified inventory.
     *
     * @param int|string $itemId
     * @param int|string $stockId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($itemId, $stockId)
    {
        if ($this->processor->destroy($itemId, $stockId)) {
            flash()->success('Success!', 'Successfully deleted stock.');

            return redirect()->route('maintenance.inventory.stocks.index', [$itemId]);
        } else {
            flash()->error('Error!', 'There was an issue deleting this stock. Please try again.');

            return redirect()->route('maintenance.inventory.stocks.show', [$itemId, $stockId]);
        }
    }
}
