<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PortraitImage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the uploaded file is an image
        if ($value && $value->isValid()) {
            // Get the dimensions of the image
            $image = Image::make($value->getRealPath());
            $height = $image->height();
            $width = $image->width();
            if ($height > $width){
                return true;
            }
            else{
                return false;
            }
        } else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a portrait image.';
    }
}
