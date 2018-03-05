<?php

namespace App\Http\Requests\Inventory;

use App\Http\Requests\Request as BaseRequest;

class InventoryRequest extends BaseRequest
{
    /**
     * The inventory validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|max:250',
            'description' => 'max:1000',
            'category'    => 'required|integer|exists:categories,id,belongs_to,inventories',
            'metric'      => 'required|integer|exists:metrics,id',
        ];
    }

    /**
     * Allows all users to create an inventory item.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
