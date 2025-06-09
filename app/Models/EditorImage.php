<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Log;

class EditorImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'public_id',
        'url',
        'original_filename',
        'user_id',
        'folder',
        'file_size',
        'format',
        'imageable_type',
        'imageable_id',
        'width',
        'height',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the image.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owning imageable model (property, recommendation, etc).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope to get orphaned images (not linked to any model).
     */
    public function scopeOrphaned($query)
    {
        return $query->whereNull('imageable_type')
            ->whereNull('imageable_id');
    }

    /**
     * Scope to get old orphaned images.
     */
    public function scopeOldOrphaned($query, $hours = 24)
    {
        return $query->orphaned()
            ->where('created_at', '<', now()->subHours($hours));
    }

    /**
     * Delete the image from Cloudinary and database.
     */
    public function deleteWithCloudinary()
    {
        try {
            // Delete from Cloudinary
            $result = app(\Cloudinary\Cloudinary::class)
                ->uploadApi()
                ->destroy($this->public_id);

            // Delete from database if Cloudinary deletion successful
            if ($result['result'] === 'ok' || $result['result'] === 'not found') {
                return $this->delete();
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Failed to delete image from Cloudinary: '.$e->getMessage(), [
                'image_id' => $this->id,
                'public_id' => $this->public_id,
            ]);

            // Still delete from database even if Cloudinary fails
            return $this->delete();
        }
    }
}
