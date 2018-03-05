<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\Request as BaseRequest;

class InventoryStockRequest extends BaseRequest
{
    /**
     * The inventory stock validation rules.
     *
     * @return array
     */
    public function rules()
    {
        $item = $this->route('inventory');
        $stock = ($this->route('stocks') ?: 'NULL');

        return [
            'location'    => "required|exists:locations,id|unique:inventory_stocks,location_id,$stock,id,inventory_id,$item",
            'quantity'    => 'required|numeric|min:0',
            'reason'      => 'max:250',
            'cost'        => 'numeric|min:0',
        ];
    }

    /**
     * Allows all users to create a stock on an inventory item.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
