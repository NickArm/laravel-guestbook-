<?php

namespace App\Actions;

use App\Models\Recommendation;
use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;

class UploadRecommendationImageAction
{
    public function execute(UploadedFile $image, Recommendation $recommendation): void
    {
        if ($recommendation->image_public_id) {
            try {
                app(Cloudinary::class)->uploadApi()->destroy($recommendation->image_public_id);
            } catch (\Exception $e) {

            }
        }

        $user = $recommendation->user;
        $userFolder = 'users/'.$user->id.'/recommendations';

        $upload = app(Cloudinary::class)->uploadApi()->upload(
            $image->getRealPath(),
            [
                'folder' => $userFolder,
                'use_filename' => true,
                'unique_filename' => false,
            ]
        );

        $recommendation->update([
            'image_url' => $upload['secure_url'],
            'image_public_id' => $upload['public_id'],
        ]);
    }
}
