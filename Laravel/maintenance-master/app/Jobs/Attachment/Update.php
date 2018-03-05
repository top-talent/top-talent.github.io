<?php

namespace App\Jobs\Attachment;

use App\Http\Requests\AttachmentUpdateRequest;
use App\Jobs\Job;
use App\Models\Attachment;

class Update extends Job
{
    /**
     * @var AttachmentUpdateRequest
     */
    protected $request;

    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * Constructor.
     *
     * @param AttachmentUpdateRequest $request
     * @param Attachment              $attachment
     */
    public function __construct(AttachmentUpdateRequest $request, Attachment $attachment)
    {
        $this->request = $request;
        $this->attachment = $attachment;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle()
    {
        $this->attachment->name = $this->request->input('name', $this->attachment->name);

        return $this->attachment->save();
    }
}
