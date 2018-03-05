<?php

namespace App\Jobs\Inventory\Stock;

use App\Http\Requests\Inventory\InventoryStockRequest;
use App\Jobs\Job;
use App\Models\Inventory;
use App\Models\InventoryStock;

class Store extends Job
{
    /**
     * @var InventoryStockRequest
     */
    protected $request;

    /**
     * @var Inventory
     */
    protected $inventory;

    /**
     * @var InventoryStock
     */
    protected $stock;

    /**
     * Constructor.
     *
     * @param InventoryStockRequest $request
     * @param Inventory             $inventory
     * @param InventoryStock        $stock
     */
    public function __construct(InventoryStockRequest $request, Inventory $inventory, InventoryStock $stock)
    {
        $this->request = $request;
        $this->inventory = $inventory;
        $this->stock = $stock;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->stock->user_id = auth()->id();
        $this->stock->inventory_id = $this->inventory->getKey();
        $this->stock->location_id = $this->request->input('location');
        $this->stock->quantity = $this->request->input('quantity');
        $this->stock->cost = $this->request->input('cost');
        $this->stock->reason = $this->request->input('reason');

        return $this->stock->save();
    }
}
