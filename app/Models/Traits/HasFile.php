<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasFile
{
    /**
     * Update the file.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function updateFile(UploadedFile $file = null, $column = 'image')
    {
        if ($file) {
            tap($this->{$column}, function ($previous) use ($file, $column) {
                $this->forceFill([
                    $column => $file->storePublicly(
                        get_class_name($this), ['disk' => $this->fileDisk()]
                    ),
                ])->save();

                if ($previous) {
                    Storage::disk($this->fileDisk())->delete($previous);
                }
            });
        }
    }

    /**
     * Delete the file.
     *
     * @return void
     */
    public function deleteFile($column = 'image')
    {
        if (is_null($this->{$column})) {
            return;
        }

        Storage::disk($this->fileDisk())->delete($this->{$column});

        $this->forceFill([
            $column => null,
        ])->save();
    }

    /**
     * Get the URL to the file.
     *
     * @return string
     */
    public function getFileUrl($column = 'image')
    {
        return $this->{$column}
            ? Storage::disk($this->fileDisk())->url($this->{$column})
            : $this->defaultFileUrl($column);
    }

    /**
     * Get the default file URL if no file has been uploaded.
     *
     * @return string
     */
    protected function defaultFileUrl($column = 'image')
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=e8604c&background=e8604c70';
    }

    /**
     * Get the disk that file should be stored on.
     *
     * @return string
     */
    protected function fileDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_photo_disk', 'public');
    }
}
