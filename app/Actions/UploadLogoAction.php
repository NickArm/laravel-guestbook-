<?php

namespace App\Actions;

use App\Models\Property;
use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;

class UploadLogoAction
{
    protected Cloudinary $cloudinary;

    public function __construct(Cloudinary $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    /**
     * Handle the logo upload and update the property.
     */
    public function execute(UploadedFile $file, Property $property): void
    {
        $upload = $this->cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => "properties/{$property->slug}",
                'public_id' => 'logo',
                'overwrite' => true,
            ]
        );

        $property->update([
            'logo_url' => $upload['secure_url'],
        ]);

    }
}
