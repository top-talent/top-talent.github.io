<?php

namespace App\Models;

use Stevebauman\Inventory\Traits\SupplierTrait;

class Supplier extends Model
{
    use SupplierTrait;

    /**
     * The suppliers table.
     *
     * @var string
     */
    protected $table = 'suppliers';

    /**
     * The belongsToMany items relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Inventory::class, 'inventory_suppliers', 'supplier_id')->withTimestamps();
    }
}
