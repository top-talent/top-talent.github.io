<?php

namespace App\Http\Requests\Asset;

use App\Http\Requests\AttachmentRequest;

class ImageRequest extends AttachmentRequest
{
    /**
     * The mimes to allow for asset image uploads.
     *
     * @var array
     */
    protected $mimes = [
        'jpg',
        'jpeg',
        'gif',
        'png',
    ];
}
