<?php

namespace App\Http\Requests;

class MetricRequest extends Request
{
    /**
     * The metric validation rules.
     *
     * @return array
     */
    public function rules()
    {
        if ($metric = $this->route('metrics')) {
            return [
                'name'   => "required|max:250|unique:metrics,name,$metric",
                'symbol' => "required|max:5|unique:metrics,symbol,$metric",
            ];
        } else {
            return [
                'name'   => 'required|max:250|unique:metrics,name',
                'symbol' => 'required|max:5|unique:metrics,symbol',
            ];
        }
    }

    /**
     * The.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
