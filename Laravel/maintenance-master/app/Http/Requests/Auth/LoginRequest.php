<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * The login validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login'    => 'required',
            'password' => 'required',
        ];
    }

    /**
     * Allows all users to login.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
