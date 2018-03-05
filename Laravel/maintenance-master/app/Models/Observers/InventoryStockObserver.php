<?php

namespace App\Models\Observers;

use App\Models\InventoryStock;

class InventoryStockObserver
{
    /**
     * Captures the Inventory Stock models deleted event
     * and cascades the delete to all of it's movements.
     *
     * @param InventoryStock $stock
     */
    public function deleted(InventoryStock $stock)
    {
        $movements = $stock->movements()->get();

        if (count($movements) > 0) {
            foreach ($movements as $movement) {
                $movement->delete();
            }
        }
    }

    /**
     * Captures the Inventory Stock models restored event
     * and cascades the restore to all of it's movements.
     *
     * @param InventoryStock $stock
     */
    public function restored(InventoryStock $stock)
    {
        $movements = $stock->movements()->onlyTrashed()->get();

        if (count($movements) > 0) {
            foreach ($movements as $movement) {
                $movement->restore();
            }
        }
    }
}
