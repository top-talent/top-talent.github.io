<?php

namespace App\Models;

use Stevebauman\Inventory\Traits\InventoryTransactionHistoryTrait;

class InventoryTransactionHistory extends Model
{
    use InventoryTransactionHistoryTrait;

    /**
     * The inventory transaction histories table.
     *
     * @var string
     */
    protected $table = 'inventory_transaction_histories';

    /**
     * The fillable inventory transaction history attributes.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'state_before',
        'state_after',
        'quantity_before',
        'quantity_after',
    ];

    /**
     * The belongsTo transaction relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(InventoryTransaction::class, 'transaction_id', 'id');
    }
}
