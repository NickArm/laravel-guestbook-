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
    ];

    protected $casts = [
        'enabled_pages' => 'array',
        'is_active' => 'boolean',
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
}
