<?php

namespace App\Models;

use Stevebauman\Inventory\Interfaces\StateableInterface;
use Stevebauman\Inventory\Traits\InventoryTransactionTrait;

class InventoryTransaction extends Model implements StateableInterface
{
    use InventoryTransactionTrait;

    /**
     * The fillable inventory transaction attributes.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id',
        'state',
        'quantity',
    ];

    /**
     * The inventory transactions table.
     *
     * @var string
     */
    protected $table = 'inventory_transactions';

    /**
     * The belongsTo stock relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo(InventoryStock::class, 'stock_id', 'id');
    }

    /**
     * The hasMany histories relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(InventoryTransactionHistory::class, 'transaction_id', 'id');
    }
}
