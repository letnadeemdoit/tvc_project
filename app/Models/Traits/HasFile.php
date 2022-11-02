<?php

namespace App\Models\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait HasFile
{
    static string $THUMBNAIL_SMALL = 'small';
    static string $THUMBNAIL_MEDIUM = 'medium';
    static string $THUMBNAIL_LARGE = 'large';

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

                $filePath = $file->storePublicly(get_class_name($this), ['disk' => $this->fileDisk()]);

                if (in_array($file->getClientOriginalExtension(), ['jpg', 'gif', 'png', 'jpeg', 'tiff'])) {
                    $storedFilePath = Storage::disk($this->fileDisk())->path($filePath);

                    Image::make($storedFilePath)->save($storedFilePath, 40, "jpg");

                    if (isset($this->generateThumbnail) && $this->generateThumbnail) {
                        //create small thumbnail
                        Storage::disk($this->fileDisk())->copy($filePath, 'thumbnails/small/' . $filePath);
                        $this->createThumbnail(Storage::disk($this->fileDisk())->path('thumbnails/small/' . $filePath), 150, 93);

                        //create medium thumbnail
                        Storage::disk($this->fileDisk())->copy($filePath, 'thumbnails/medium/' . $filePath);
                        $this->createThumbnail(Storage::disk($this->fileDisk())->path('thumbnails/medium/' . $filePath), 300, 185);

                        //create large thumbnail
                        Storage::disk($this->fileDisk())->copy($filePath, 'thumbnails/large/' . $filePath);
                        $this->createThumbnail(Storage::disk($this->fileDisk())->path('thumbnails/large/' . $filePath), 550, 340);
                    }
                }
                $this->forceFill([
                    $column => $filePath,
                ])->save();

                if ($previous) {
                    Storage::disk($this->fileDisk())->delete($previous);

                    if (in_array(\File::extension($previous), ['jpg', 'gif', 'png', 'jpeg', 'tiff'])) {
                        Storage::disk($this->fileDisk())->delete('thumbnails/large/' . $previous);
                        Storage::disk($this->fileDisk())->delete('thumbnails/medium/' . $previous);
                        Storage::disk($this->fileDisk())->delete('thumbnails/small/' . $previous);
                    }
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

        if (in_array(\File::extension($this->{$column}), ['jpg', 'gif', 'png', 'jpeg', 'tiff'])) {
            Storage::disk($this->fileDisk())->delete('thumbnails/large/' . $this->{$column});
            Storage::disk($this->fileDisk())->delete('thumbnails/medium/' . $this->{$column});
            Storage::disk($this->fileDisk())->delete('thumbnails/small/' . $this->{$column});
        }

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
     * Get the URL to the file.
     *
     * @return string
     */
    public function getThumbnailUrl($size = 'small', $column = 'image')
    {
        return $this->{$column}
            ? Storage::disk($this->fileDisk())->url("thumbnails/$size/" . $this->{$column})
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

    /**
     * Create a thumbnail of specified size
     *
     * @param string $path path of thumbnail
     * @param int $width
     * @param int $height
     */
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($path);
    }
}
