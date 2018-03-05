<?php

namespace App\Http\Requests;

class WorkRequest extends Request
{
    /**
     * The work request validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject'     => 'required|min:10',
            'description' => 'required|min:10',
            'best_time'   => 'required|min:4',
        ];
    }

    /**
     * Allows all users to create work requests.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
