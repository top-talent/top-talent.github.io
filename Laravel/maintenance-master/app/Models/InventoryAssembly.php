<?php

namespace App\Models;

class InventoryAssembly extends Model
{
    /**
     * The inventory assemblies table.
     *
     * @var string
     */
    protected $table = 'inventory_assemblies';

    /**
     * The fillable inventory assemblies attributes.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'part_id',
        'quantity',
    ];
}
