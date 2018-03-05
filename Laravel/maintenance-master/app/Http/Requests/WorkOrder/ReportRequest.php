<?php

namespace App\Http\Requests\WorkOrder;

use App\Http\Requests\Request;

class ReportRequest extends Request
{
    /**
     * The report validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status'      => 'required|integer|exists:statuses,id',
            'description' => 'required|min:5',
        ];
    }

    /**
     * Allows all users to create a report.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
