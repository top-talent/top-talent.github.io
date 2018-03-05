<?php

namespace App\Jobs\Attachment;

use App\Jobs\Job;
use App\Models\Attachment;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Flysystem\FileNotFoundException;

class Destroy extends Job
{
    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * Constructor.
     *
     * @param Attachment $attachment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Deletes the current attachment as well as the file.
     *
     * @param Filesystem $filesystem
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function handle(Filesystem $filesystem)
    {
        try {
            if ($filesystem->delete($this->attachment->getStorageFilePath())) {
                return $this->attachment->delete();
            }
        } catch (FileNotFoundException $e) {
            //
        }

        return false;
    }
}
