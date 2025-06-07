<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recommendation extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'image_url',
        'image_public_id',
        'description',
        'website_url',
        'directions_url',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function category()
    {
        return $this->belongsTo(RecommendationCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
