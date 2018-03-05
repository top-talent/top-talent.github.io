<?php

namespace App\Viewers\Inventory;

use App\Viewers\BaseViewer;

class InventoryViewer extends BaseViewer
{
    public function profile()
    {
        return view('viewers.inventory.profile', ['item' => $this->entity]);
    }

    public function variants()
    {
        return view('viewers.inventory.variants', ['item' => $this->entity]);
    }

    public function calendar()
    {
        return view('viewers.inventory.calendar', ['item' => $this->entity]);
    }

    public function stock()
    {
        return view('viewers.inventory.stock', ['item' => $this->entity]);
    }

    public function notes()
    {
        return view('viewers.inventory.notes', ['item' => $this->entity]);
    }

    public function btnAddNote()
    {
        return view('viewers.inventory.buttons.add-note', ['item' => $this->entity]);
    }

    public function btnAddStock()
    {
        return view('viewers.inventory.buttons.add-stock', ['item' => $this->entity]);
    }

    public function btnRegenerateSku()
    {
        return view('viewers.inventory.buttons.regenerate-sku', ['item' => $this->entity]);
    }

    public function btnEvents()
    {
        return view('viewers.inventory.buttons.events', ['item' => $this->entity]);
    }

    public function btnEdit()
    {
        return view('viewers.inventory.buttons.edit', ['item' => $this->entity]);
    }

    public function btnDelete()
    {
        return view('viewers.inventory.buttons.delete', ['item' => $this->entity]);
    }

    public function btnActions()
    {
        return view('viewers.inventory.buttons.actions', ['item' => $this->entity]);
    }

    public function btnActionsArchive()
    {
        return view('viewers.inventory.buttons.actions-archive', ['item' => $this->entity]);
    }

    public function btnSelectForWorkOrder($workOrder)
    {
        return view('viewers.inventory.buttons.select-work-order', [
            'workOrder' => $workOrder,
            'item'      => $this->entity,
        ]);
    }

    public function btnEventTag()
    {
        return view('viewers.inventory.buttons.event-tag', [
            'item' => $this->entity,
        ]);
    }

    public function btnNoteActions($note)
    {
        return view('viewers.inventory.buttons.note-actions', [
            'item' => $this->entity,
            'note' => $note,
        ]);
    }

    public function btnCreateVariant()
    {
        return view('viewers.inventory.buttons.create-variant', [
            'item' => $this->entity,
        ]);
    }

    public function lblCurrentStock()
    {
        $stock = $this->entity->getTotalStock();
        $variantStock = $this->entity->getTotalVariantStock();

        $totalStock = (float) $stock + (float) $variantStock;

        return view('viewers.inventory.labels.current-stock', [
            'currentStock'        => $totalStock,
            'currentVariantStock' => $variantStock,
        ])->render();
    }
}
