<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request as BaseRequest;

class BetweenRequest extends BaseRequest
{
    /**
     * The between request validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|min:10|max:10',
            'end'   => 'required|min:10|max:10',
        ];
    }

    /**
     * Allows all users to view events between two specified times.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
