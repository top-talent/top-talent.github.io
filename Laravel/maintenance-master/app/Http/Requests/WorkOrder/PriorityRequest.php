<?php

namespace App\Http\Requests\WorkOrder;

use App\Http\Requests\Request;

class PriorityRequest extends Request
{
    /**
     * The priority validation rules.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'color' => 'required|max:20',
        ];

        $priority = $this->route('priorities');

        if ($priority) {
            $rules['name'] = "required|max:250|unique:priorities,name,$priority";
        } else {
            $rules['name'] = 'required|max:250|unique:priorities,name';
        }

        return $rules;
    }

    /**
     * Allows all users to create work order priorities.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
