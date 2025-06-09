<?php

namespace App\Http\Controllers;

use App\Models\EditorImage;
use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EditorImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max
        ]);

        if ($request->hasFile('image')) {
            try {
                $cloudinary = app(Cloudinary::class);
                $user = Auth::user();
                $image = $request->file('image');

                // Generate unique public_id (without folder prefix)
                $timestamp = time();
                $uniqueId = uniqid();
                $publicId = "{$uniqueId}_{$timestamp}";

                // Upload to Cloudinary with correct parameters
                $uploadOptions = [
                    'public_id' => $publicId,
                    'folder' => "users/{$user->id}/editor-images",
                    'resource_type' => 'image',
                    'quality' => 'auto:good',
                    'transformation' => [
                        'quality' => 'auto:good',
                        'fetch_format' => 'auto',
                    ],
                ];

                // For specific formats, we can add eager transformations
                if (in_array($image->getClientOriginalExtension(), ['png', 'jpg', 'jpeg'])) {
                    $uploadOptions['eager'] = [
                        ['width' => 1920, 'height' => 1080, 'crop' => 'limit', 'quality' => 'auto:good'],
                    ];
                    $uploadOptions['eager_async'] = true;
                }

                $upload = $cloudinary->uploadApi()->upload(
                    $image->getRealPath(),
                    $uploadOptions
                );

                // Store in database
                $editorImage = EditorImage::create([
                    'public_id' => $upload['public_id'],
                    'url' => $upload['secure_url'],
                    'original_filename' => $image->getClientOriginalName(),
                    'user_id' => $user->id,
                    'folder' => "users/{$user->id}/editor-images",
                    'file_size' => $upload['bytes'] ?? null,
                    'format' => $upload['format'] ?? null,
                ]);

                return response()->json([
                    'url' => $upload['secure_url'],
                    'public_id' => $upload['public_id'],
                    'id' => $editorImage->id,
                    'success' => true,
                ]);
            } catch (ApiError $e) {
                Log::error('Cloudinary API error: '.$e->getMessage(), [
                    'user_id' => Auth::id(),
                    'file_name' => $image->getClientOriginalName(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return response()->json([
                    'error' => 'Upload failed: '.$e->getMessage(),
                ], 500);

            } catch (\Exception $e) {
                Log::error('Upload error: '.$e->getMessage(), [
                    'user_id' => Auth::id(),
                    'file_name' => $request->file('image')->getClientOriginalName(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return response()->json([
                    'error' => 'Upload failed: '.$e->getMessage(),
                ], 500);
            }
        }

        return response()->json(['error' => 'No image found.'], 400);
    }

    public function delete(Request $request)
    {
        try {
            $url = $request->input('url');
            $publicId = $request->input('public_id');
            $imageId = $request->input('id');

            if (! $url && ! $publicId && ! $imageId) {
                return response()->json(['error' => 'No URL, public_id, or image ID provided'], 400);
            }

            $editorImage = null;

            // Try to find by database ID first
            if ($imageId) {
                $editorImage = EditorImage::find($imageId);
            }

            // If not found, try by public_id
            if (! $editorImage && $publicId) {
                $editorImage = EditorImage::where('public_id', $publicId)->first();
            }

            // If still not found, try by URL
            if (! $editorImage && $url) {
                $editorImage = EditorImage::where('url', $url)->first();
            }

            // If we have a database record, use its public_id
            if ($editorImage) {
                $publicId = $editorImage->public_id;

                // Check if user owns this image (security check)
                if ($editorImage->user_id !== Auth::id()) {
                    return response()->json(['error' => 'Unauthorized to delete this image'], 403);
                }
            } else {
                // Fallback: extract public_id from URL
                if (! $publicId && $url) {
                    $publicId = $this->extractCloudinaryPublicId($url);
                }
            }

            if (! $publicId) {
                return response()->json(['error' => 'Could not determine public_id for deletion'], 400);
            }

            // Delete from Cloudinary
            $result = app(Cloudinary::class)->uploadApi()->destroy($publicId);

            // Delete from database if record exists
            if ($editorImage) {
                $editorImage->delete();
            }

            if ($result['result'] === 'ok' || $result['result'] === 'not found') {
                return response()->json([
                    'success' => true,
                    'message' => 'Image deleted successfully',
                    'cloudinary_result' => $result['result'],
                ]);
            }

            return response()->json([
                'error' => 'Failed to delete from Cloudinary',
                'cloudinary_result' => $result,
            ], 500);

        } catch (\Exception $e) {
            Log::error('Image deletion failed: '.$e->getMessage(), [
                'user_id' => Auth::id(),
                'url' => $request->input('url'),
                'public_id' => $request->input('public_id'),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Deletion failed: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Link images to a specific model (e.g., when saving a post)
     */
    public function linkImages(Request $request)
    {
        $request->validate([
            'image_ids' => 'required|array',
            'image_ids.*' => 'exists:editor_images,id',
            'model_type' => 'required|string',
            'model_id' => 'required|integer',
        ]);

        try {
            $updated = EditorImage::whereIn('id', $request->image_ids)
                ->where('user_id', Auth::id())
                ->update([
                    'imageable_type' => $request->model_type,
                    'imageable_id' => $request->model_id,
                ]);

            return response()->json([
                'success' => true,
                'updated_count' => $updated,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to link images: '.$e->getMessage());

            return response()->json(['error' => 'Failed to link images'], 500);
        }
    }

    /**
     * Get user's uploaded images
     */
    public function getUserImages(Request $request)
    {
        try {
            $query = EditorImage::where('user_id', Auth::id());

            // Optional filters
            if ($request->has('orphaned')) {
                $query->orphaned();
            }

            if ($request->has('linked_to')) {
                $query->where('imageable_type', $request->input('linked_to'));
            }

            $images = $query->orderBy('created_at', 'desc')
                ->paginate($request->input('per_page', 20));

            return response()->json($images);

        } catch (\Exception $e) {
            Log::error('Failed to fetch user images: '.$e->getMessage());

            return response()->json(['error' => 'Failed to fetch images'], 500);
        }
    }

    /**
     * Clean up orphaned images (images not linked to any content)
     */
    public function cleanupOrphaned()
    {
        try {
            $orphanedImages = EditorImage::where('user_id', Auth::id())
                ->orphaned()
                ->where('created_at', '<', now()->subHours(24))
                ->get();

            $deletedCount = 0;
            $errors = [];

            foreach ($orphanedImages as $image) {
                try {
                    if ($image->deleteWithCloudinary()) {
                        $deletedCount++;
                    } else {
                        $errors[] = "Failed to delete image ID: {$image->id}";
                    }
                } catch (\Exception $e) {
                    $errors[] = "Error deleting image ID {$image->id}: ".$e->getMessage();
                    Log::error('Failed to delete orphaned image', [
                        'image_id' => $image->id,
                        'public_id' => $image->public_id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $response = [
                'success' => true,
                'deleted_count' => $deletedCount,
                'total_orphaned' => $orphanedImages->count(),
                'message' => "Deleted {$deletedCount} of {$orphanedImages->count()} orphaned images",
            ];

            if (! empty($errors)) {
                $response['errors'] = $errors;
            }

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Cleanup orphaned images failed: '.$e->getMessage());

            return response()->json(['error' => 'Cleanup failed'], 500);
        }
    }

    /**
     * Extract Cloudinary public ID from URL
     */
    private function extractCloudinaryPublicId($url)
    {
        try {
            // Remove query parameters
            $url = strtok($url, '?');

            // Example URL: https://res.cloudinary.com/dn6uygzkt/image/upload/v1749486398/users/9f18bb56-84a2-4874-8af0-cb3baf56c738/editor-images/68470b3d800f0_1749486397.jpg

            // Pattern for URLs with folder structure
            $pattern = '/\/v\d+\/(.*)\.\w+$/';

            if (preg_match($pattern, $url, $matches)) {
                // This will return the full path including folders
                return $matches[1];
            }

            // Alternative pattern without version
            $pattern2 = '/\/upload\/(.*)\.\w+$/';

            if (preg_match($pattern2, $url, $matches)) {
                return $matches[1];
            }

            return null;

        } catch (\Exception $e) {
            Log::error('Failed to extract Cloudinary public ID', [
                'url' => $url,
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
