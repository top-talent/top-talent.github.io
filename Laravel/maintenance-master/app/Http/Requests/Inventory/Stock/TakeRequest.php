<?php

namespace App\Http\Requests\Inventory\Stock;

use App\Http\Requests\Request as BaseRequest;

class TakeRequest extends BaseRequest
{
    /**
     * The stock take validation rules.
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
     * Allows all users to take inventory stock.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
