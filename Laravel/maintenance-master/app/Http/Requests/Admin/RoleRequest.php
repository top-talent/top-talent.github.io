<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class RoleRequest extends Request
{
    /**
     * The group validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:250',
        ];
    }

    /**
     * Allows all users to create roles.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
