<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    protected $fillable = ['title', 'description', 'url'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
