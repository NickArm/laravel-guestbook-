<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasUuids;

    protected $fillable = ['property_id', 'name', 'photo', 'message', 'contacts'];

    protected $casts = [
        'contacts' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
