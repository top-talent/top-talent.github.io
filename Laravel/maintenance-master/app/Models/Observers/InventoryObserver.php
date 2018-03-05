<?php

namespace App\Models\Observers;

use App\Models\Inventory;

class InventoryObserver
{
    /**
     * Captures the Inventory models deleted event
     * and cascades the delete to all of it's stocks.
     *
     * @param Inventory $model
     */
    public function deleted(Inventory $model)
    {
        $stocks = $model->stocks()->get();

        if (count($stocks) > 0) {
            foreach ($stocks as $stock) {
                $stock->delete();
            }
        }
    }

    /**
     * Captures the Inventory models restored event
     * and cascades the restore to all of it's stocks.
     *
     * @param Inventory $model
     */
    public function restored(Inventory $model)
    {
        $stocks = $model->stocks()->onlyTrashed()->get();

        if (count($stocks) > 0) {
            foreach ($stocks as $stock) {
                $stock->restore();
            }
        }
    }
}
