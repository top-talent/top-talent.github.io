<?php

namespace App\Http\Requests\Asset;

use App\Http\Requests\AttachmentRequest;

class ManualRequest extends AttachmentRequest
{
    /**
     * The mimes to allow for asset manual uploads.
     *
     * @var array
     */
    protected $mimes = [
        'pdf',
        'txt',
        'doc',
        'docx',
        'xlx',
        'xlsx',
        'ppt',
        'pptx',
    ];
}
