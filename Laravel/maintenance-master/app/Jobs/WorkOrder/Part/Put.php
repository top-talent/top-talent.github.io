<?php

namespace App\Jobs\WorkOrder\Part;

use App\Http\Requests\WorkOrder\PartReturnRequest;
use App\Jobs\Job;
use App\Models\InventoryStock;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Put extends Job
{
    /**
     * @var PartReturnRequest
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
     * @param PartReturnRequest $request
     * @param WorkOrder         $workOrder
     * @param InventoryStock    $stock
     */
    public function __construct(PartReturnRequest $request, WorkOrder $workOrder, InventoryStock $stock)
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
        // Get the requested quantity to return
        $quantity = $this->request->input('quantity');

        // We'll double check that the stock model we've been given contains
        // the pivot attribute, indicating it's been retrieved
        // from the work order.
        if ($this->stock->pivot instanceof Pivot) {
            if ($quantity > $this->stock->pivot->quantity) {
                // If the quantity entered is greater than the
                // taken stock, we'll return all of the stock.
                $returnQuantity = $this->stock->pivot->quantity;
            } else {
                // Otherwise we can use the users quantity input.
                $returnQuantity = $quantity;
            }

            // Set the stock put reason.
            $reason = link_to_route('maintenance.work-orders.show', 'Put Back from Work Order', [$this->workOrder->getKey()]);

            // Return the specified quantity.
            $this->stock->put($returnQuantity, $reason);

            // Retrieve the left over quantity for the work order.
            $newQuantity = $this->stock->pivot->quantity - $returnQuantity;

            if ($newQuantity == 0) {
                // If the new quantity is zero, we'll detach the
                // stock record from the work order parts.
                $this->workOrder->parts()->detach($this->stock->getKey());
            } else {
                // Otherwise we'll update the quantity on the pivot record.
                $this->workOrder->parts()->updateExistingPivot($this->stock->getKey(), ['quantity' => $newQuantity]);
            }

            return true;
        }

        return false;
    }
}
