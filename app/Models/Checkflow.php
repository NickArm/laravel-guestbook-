<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkflow extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'property_id',
        'checkin',
        'checkin_instructions',
        'checkout',
        'checkout_instructions',
        'checkin_video',
        'checkout_video',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
