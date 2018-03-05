<?php

namespace App\Http\Requests\WorkOrder;

use App\Http\Requests\Request as BaseRequest;

class StatusRequest extends BaseRequest
{
    /**
     * The status validation rules.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'color' => 'required|max:20',
        ];

        $status = $this->route('statuses');

        if ($status) {
            $rules['name'] = "required|max:250|unique:statuses,name,$status";
        } else {
            $rules['name'] = 'required|max:250|unique:statuses,name';
        }

        return $rules;
    }

    /**
     * Allows all users to create work order statuses.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
