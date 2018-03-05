<?php

namespace App\Http\Requests\Inventory\Stock;

use App\Http\Requests\Request as BaseRequest;

class PutRequest extends BaseRequest
{
    /**
     * The stock put validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|positive',
        ];
    }

    /**
     * Allows all users to put inventory stock.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
