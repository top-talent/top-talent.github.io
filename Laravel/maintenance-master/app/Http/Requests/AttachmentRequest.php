<?php

namespace App\Http\Requests;

class AttachmentRequest extends Request
{
    /**
     * The mimes to allow for file uploads.
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
        'jpg',
        'jpeg',
        'gif',
        'png',
    ];

    /**
     * The maximum allowed file size in kilobytes.
     *
     * @var int
     */
    protected $maxSize = 15000;

    /**
     * The upload validation rules.
     *
     * @return array
     */
    public function rules()
    {
        $mimes = $this->getMimes();

        $size = $this->getMaxSize();

        $rule = "required|mimes:$mimes|max:$size";

        return [
            'files.*' => $rule,
        ];
    }

    /**
     * Allows all users to upload files.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Returns the maximum allowed size for each attachment.
     *
     * @return string
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * Returns the valid mimes in a single string.
     *
     * @return string
     */
    public function getMimes()
    {
        return implode(',', $this->mimes);
    }
}
