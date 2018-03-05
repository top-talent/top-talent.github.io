<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request as BaseRequest;

class MoveRequest extends BaseRequest
{
    /**
     * The move validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|min:10',
            'end'   => 'required|min:10',
        ];
    }

    /**
     * Allows all users to move events.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
