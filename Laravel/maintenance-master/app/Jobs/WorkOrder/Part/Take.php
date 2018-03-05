<?php

namespace App\Jobs\WorkOrder\Part;

use App\Http\Requests\WorkOrder\PartTakeRequest;
use App\Jobs\Job;
use App\Models\InventoryStock;
use App\Models\WorkOrder;

class Take extends Job
{
    /**
     * @var PartTakeRequest
     */
    protected $request;

    /**
     * @var WorkOrder
     */
    protected $workOrder;

    /**
     * @var InventoryStock
     */
    protected $stock;

    /**
     * Constructor.
     *
     * @param PartTakeRequest $request
     * @param WorkOrder       $workOrder
     * @param InventoryStock  $stock
     */
    public function __construct(PartTakeRequest $request, WorkOrder $workOrder, InventoryStock $stock)
    {
        $this->request = $request;
        $this->workOrder = $workOrder;
        $this->stock = $stock;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $quantity = $this->request->input('quantity');

        $reason = link_to_route('maintenance.work-orders.show', 'Used for Work Order', [$this->workOrder->getKey()]);

        $this->stock->take($quantity, $reason);

        // We'll check if the work order currently has the stock already attached.
        $stock = $this->workOrder->parts()->find($this->stock->getKey());

        if ($stock instanceof InventoryStock) {
            // Add on the quantity inputted to the existing record quantity.
            $newQuantity = $stock->pivot->quantity + $quantity;

            $this->workOrder->parts()->updateExistingPivot($stock->getKey(), ['quantity' => $newQuantity]);

            return true;
        }

        // It looks like the part isn't yet attached to
        // the work order. We'll attach it now.
        $this->workOrder->parts()->attach($this->stock->getKey(), compact('quantity'));

        return true;
    }
}
