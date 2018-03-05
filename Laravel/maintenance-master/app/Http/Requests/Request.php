<?php

namespace App\Http\Requests;

use Orchestra\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;

abstract class Request extends FormRequest
{
    /**
     * Cleans a string or array of HTML input.
     *
     * @param string|array $input
     *
     * @return string|array
     */
    public function clean($input)
    {
        return Purify::clean($input);
    }

    /**
     * @param string      $date
     * @param string|null $time
     *
     * @return bool|null|string
     */
    public function formatDateWithTime($date, $time = null)
    {
        if (!empty($date)) {
            if (!empty($time)) {
                return date('Y-m-d H:i:s', strtotime($date.' '.$time));
            }

            return date('Y-m-d H:i:s', strtotime($date));
        }

        return;
    }
}
