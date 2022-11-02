<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ReducePhotosSizeAndGenerateThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\Storage::disk('public')->files('photos') as $photo) {

            if (in_array(\File::extension($photo), ['jpeg', 'gif', 'png', 'jpeg', 'tiff'])) {
                $storedFilePath = Storage::disk('public')->path($photo);

                Image::make($storedFilePath)->save($storedFilePath, 40, "jpg");

                Storage::disk('public')->copy($photo, 'thumbnails/small/' . $photo);
                $this->createThumbnail(Storage::disk('public')->path('thumbnails/small/' . $photo), 150, 93);

                //create medium thumbnail
                Storage::disk('public')->copy($photo, 'thumbnails/medium/' . $photo);
                $this->createThumbnail(Storage::disk('public')->path('thumbnails/medium/' . $photo), 300, 185);

                //create large thumbnail
                Storage::disk('public')->copy($photo, 'thumbnails/large/' . $photo);
                $this->createThumbnail(Storage::disk('public')->path('thumbnails/large/' . $photo), 550, 340);
            }
        }
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
