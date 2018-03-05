<?php

namespace App\Jobs\Attachment;

use App\Http\Requests\AttachmentRequest;
use App\Jobs\Job;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Store extends Job
{
    /**
     * @var AttachmentRequest
     */
    protected $request;

    /**
     * @var BelongsToMany
     */
    protected $relation;

    /**
     * The storage path to upload files to.
     *
     * @var string
     */
    protected $path = 'files';

    /**
     * Constructor.
     *
     * @param AttachmentRequest $request
     * @param BelongsToMany     $relation
     */
    public function __construct(AttachmentRequest $request, BelongsToMany $relation)
    {
        $this->request = $request;
        $this->relation = $relation;
    }

    /**
     * Uploads and attaches files for the current relation.
     *
     * @param Filesystem $filesystem
     *
     * @return bool|array
     */
    public function handle(Filesystem $filesystem)
    {
        $files = $this->request->file('files');

        if (is_array($files)) {
            $uploaded = [];

            foreach ($files as $file) {
                // Double check that we have an uploaded file instance.
                if ($file instanceof UploadedFile) {
                    // Generates the unique file name.
                    $name = implode('.', [uuid(), $file->getClientOriginalExtension()]);

                    // Generates the complete storage path.
                    $path = implode(DIRECTORY_SEPARATOR, [$this->path, $name]);

                    // Try and move the uploaded file into storage.
                    if ($filesystem->put($path, file_get_contents($file->getRealPath()))) {
                        // Successfully moved uploaded file, create the record.

                        $attributes = [
                            'user_id'   => auth()->id(),
                            'name'      => $file->getClientOriginalName(),
                            'file_name' => $name,
                            'file_path' => $path,
                        ];

                        $uploaded[] = $this->relation->create($attributes);
                    }
                }
            }

            return $uploaded;
        }

        return false;
    }
}
