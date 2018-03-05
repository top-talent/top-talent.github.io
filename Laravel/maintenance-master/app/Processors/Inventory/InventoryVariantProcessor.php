<?php

namespace App\Processors\Inventory;

use App\Http\Presenters\Inventory\InventoryPresenter;
use App\Http\Requests\Inventory\InventoryRequest;
use App\Models\Inventory;
use App\Processors\Processor;

class InventoryVariantProcessor extends Processor
{
    /**
     * @var Inventory
     */
    protected $inventory;

    /**
     * @var InventoryPresenter
     */
    protected $presenter;

    /**
     * Constructor.
     *
     * @param Inventory          $inventory
     * @param InventoryPresenter $presenter
     */
    public function __construct(Inventory $inventory, InventoryPresenter $presenter)
    {
        $this->inventory = $inventory;
        $this->presenter = $presenter;
    }

    /**
     * Displays the form for creating a variant for the specified inventory item.
     *
     * @param int|string $itemId
     *
     * @return \Illuminate\View\View
     */
    public function create($itemId)
    {
        $item = $this->inventory->findOrFail($itemId);

        $form = $this->presenter->form($item, $variant = true);

        return view('inventory.variants.create', compact('form'));
    }

    /**
     * Creates a variant of the specified inventory item.
     *
     * @param InventoryRequest $request
     * @param int|string       $itemId
     *
     * @return bool
     */
    public function store(InventoryRequest $request, $itemId)
    {
        $item = $this->inventory->findOrFail($itemId);

        $variant = $item->newVariant();

        $variant->name = $request->input('name', $item->name);
        $variant->category_id = $request->input('category', $item->category_id);
        $variant->metric_id = $request->input('metric', $item->metric_id);

        return $variant->save();
    }
}
