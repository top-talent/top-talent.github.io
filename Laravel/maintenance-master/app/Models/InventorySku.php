<?php

namespace App\Models;

use Stevebauman\Inventory\Traits\InventorySkuTrait;

class InventorySku extends Model
{
    use InventorySkuTrait;

    /**
     * The inventory SKUs table.
     *
     * @var string
     */
    protected $table = 'inventory_skus';

    /**
     * The fillable inventory SKU attributes.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'prefix',
        'code',
    ];

    /**
     * The belongsTo item trait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }
}
