<?php

namespace App\Http\Requests\WorkOrder;

use App\Http\Requests\Request as BaseRequest;

class PartReturnRequest extends BaseRequest
{
    /**
     * The stock request validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|numeric|min:0.1',
        ];
    }

    /**
     * Allows all users to attach stock to work orders.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
