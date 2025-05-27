<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = ['property_id', 'title', 'description'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
