<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\AttachmentViewer;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasUserTrait;

    /**
     * The attachments table.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * The storage disk.
     *
     * @var string
     */
    protected $disk = 'local';

    /**
     * The attachments viewer.
     *
     * @var string
     */
    protected $viewer = AttachmentViewer::class;

    /**
     * The fillable attachment attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'file_name',
        'file_path',
    ];

    /**
     * Returns the disk to store files on.
     *
     * @return string
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Returns the attachments relative storage file path.
     *
     * @return string
     */
    public function getStorageFilePath()
    {
        return $this->file_path;
    }

    /**
     * Returns the full path of the uploaded file.
     *
     * @return string
     */
    public function getFullPathAttribute()
    {
        $config = sprintf('filesystems.%s.root', $this->getDisk());

        $default = storage_path('app');

        $basePath = config($config, $default);

        return $basePath.DIRECTORY_SEPARATOR.$this->file_path;
    }

    /**
     * Returns the complete download path for the uploaded file.
     *
     * @return string
     */
    public function getDownloadPathAttribute()
    {
        return $this->getFullPathAttribute();
    }

    /**
     * Returns the last modified date of the uploaded file.
     *
     * @return string
     */
    public function getLastModifiedAttribute()
    {
        return Storage::disk($this->getDisk())->lastModified($this->file_path);
    }

    /**
     * Returns the size in bytes of the uploaded file.
     *
     * @return string
     */
    public function getSizeAttribute()
    {
        return Storage::disk($this->getDisk())->size($this->file_path);
    }

    /**
     * Returns the extension of the uploaded file.
     *
     * @return string
     */
    public function getMimeTypeAttribute()
    {
        return Storage::disk($this->getDisk())->getMimetype($this->file_path);
    }

    /**
     * Returns a large icon representing the uploaded file type.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        $mime = $this->getMimeTypeAttribute();

        return view('partials.models.attachment.icon', compact('mime'))->render();
    }
}
