<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Processors\Inventory\InventorySkuProcessor;

class InventorySkuController extends Controller
{
    /**
     * @var InventorySkuProcessor
     */
    protected $processor;

    /**
     * @param InventorySkuProcessor $processor
     */
    public function __construct(InventorySkuProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Regenerates the SKU for the specified item.
     *
     * @param int|string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function regenerate($id)
    {
        if ($this->processor->regenerate($id)) {
            flash()->success('Success!', 'Successfully regenerated SKU.');

            return redirect()->route('maintenance.inventory.show', [$id]);
        } else {
            flash()->error('Error!', 'There was an issue regenerating the SKU for this item. Please try again.');

            return redirect()->route('maintenance.inventory.show', [$id]);
        }
    }
}
