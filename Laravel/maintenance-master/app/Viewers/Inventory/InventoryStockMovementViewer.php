<?php

namespace App\Viewers\Inventory;

use App\Viewers\BaseViewer;

class InventoryStockMovementViewer extends BaseViewer
{
    public function profile()
    {
        return view('viewers.inventory.stock.movement.profile', ['movement' => $this->entity]);
    }

    public function btnRollback($item, $stock)
    {
        return view('viewers.inventory.stock.movement.buttons.rollback', [
            'item'     => $item,
            'stock'    => $stock,
            'movement' => $this->entity,
        ]);
    }

    public function btnActions($item, $stock)
    {
        return view('viewers.inventory.stock.movement.buttons.actions', [
            'item'     => $item,
            'stock'    => $stock,
            'movement' => $this->entity,
        ]);
    }
}
