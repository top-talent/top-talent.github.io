<?php

namespace App\Http\Requests\Asset;

use App\Http\Requests\Request as BaseRequest;

class MeterRequest extends BaseRequest
{
    /**
     * The meter validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'metric'  => 'required|integer',
            'name'    => 'required|max:250',
            'reading' => 'positive',
            'comment' => 'max:250',
        ];
    }

    /**
     * Allows all users to create meters for assets.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
