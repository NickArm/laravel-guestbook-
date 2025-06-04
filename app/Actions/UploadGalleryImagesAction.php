<?php

namespace App\Actions;

use App\Models\Property;
use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class UploadGalleryImagesAction
{
    public function __construct(protected Cloudinary $cloudinary) {}

    /**
     * @param  UploadedFile[]|Collection  $images
     */
    public function execute(Property $property, iterable $images): void
    {
        $existingCount = $property->images()->count();
        $imageCount = count($images);

        if (($existingCount + $imageCount) > 10) {
            abort(422, 'You can upload up to 10 images in total.');
        }

        foreach ($images as $image) {
            $upload = $this->cloudinary->uploadApi()->upload(
                $image->getRealPath(),
                [
                    'folder' => 'properties/'.$property->slug.'/gallery',
                    'use_filename' => true,
                    'unique_filename' => false,
                ]
            );

            $property->images()->create([
                'url' => $upload['secure_url'],
                'public_id' => $upload['public_id'],
            ]);
        }
    }
}
