<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Property extends Model
{
    use HasFactory, HasUuids, LogsActivity;

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

    protected static function booted()
    {

        parent::booted();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = $property->generateUniqueSlug($property->name);
            }
        });

        static::updating(function ($property) {
            if ($property->isDirty('slug') && $property->getOriginal('slug')) {
                $property->slug = $property->getOriginal('slug');
            }
        });
    }

    public function generateUniqueSlug($name)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? null)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Get the route key for the model (uses slug for routing)
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'slug',
                'logo_url',
                'address',
                'enabled_pages',
                'is_active',
                'checkin',
                'checkout',
                'welcome_title',
                'location_area',
                'google_map_url',
                'property_directions',
            ])
            ->useLogName('property')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relationships
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

    public function beforeYouGoNotes()
    {
        return $this->hasMany(BeforeYouGo::class);
    }

    public function recommendations()
    {
        return $this->belongsToMany(Recommendation::class);
    }

    public function appliances()
    {
        return $this->hasMany(Appliance::class);
    }
}
