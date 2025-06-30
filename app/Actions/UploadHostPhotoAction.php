<?php

namespace App\Actions;

use App\Models\Property;
use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;

class UploadHostPhotoAction
{
    public function __construct(protected Cloudinary $cloudinary) {}

    public function execute(Property $property, UploadedFile $photo): array
    {
        $folder = 'properties/'.$property->slug.'/host';

        $uploadResult = $this->cloudinary->uploadApi()->upload($photo->getRealPath(), [
            'folder' => $folder,
            'public_id' => 'host_photo',
            'overwrite' => true,
        ]);

        return [
            'url' => $uploadResult['secure_url'],
            'public_id' => $uploadResult['public_id'],
        ];
    }
}
