<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'primary_color',
        'secondary_color',
        'blog_url',
        'gyg_widget_code',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
