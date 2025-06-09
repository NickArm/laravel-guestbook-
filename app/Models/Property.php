<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'logo_url',
        'gallery',
        'address',
        'enabled_pages',
        'is_active',
        'user_id',
        'checkin',
        'checkin_instructions',
        'checkout',
        'checkout_instructions',
        'welcome_title',
        'welcome_message',
        'amenities_description',
        'location_area',
        'location_country',
        'google_map_url',
        'location_description',
        'property_directions',
    ];

    protected $casts = [
        'enabled_pages' => 'array',
        'is_active' => 'boolean',
        'gallery' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function wifi()
    {
        return $this->hasOne(Wifi::class);
    }

    public function transportation()
    {
        return $this->hasMany(Transportation::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function settings()
    {
        return $this->hasOne(Setting::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function beforeYouGo()
    {
        return $this->hasOne(BeforeYouGo::class);
    }

    public function recommendations()
    {
        return $this->belongsToMany(Recommendation::class);
    }

    public function editorImages()
    {
        return $this->morphMany(EditorImage::class, 'imageable');
    }
}
