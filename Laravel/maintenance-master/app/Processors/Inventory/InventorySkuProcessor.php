<?php

namespace App\Processors\Inventory;

use App\Models\Inventory;
use App\Processors\Processor;

class InventorySkuProcessor extends Processor
{
    /**
     * @var Inventory
     */
    protected $inventory;

    /**
     * Constructor.
     *
     * @param Inventory $inventory
     */
    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    /**
     * Regenerates the SKU of the specified inventory item.
     *
     * @param int|string $id
     *
     * @return bool
     */
    public function regenerate($id)
    {
        $item = $this->inventory->findOrFail($id);

        return $item->regenerateSku();
    }
}
