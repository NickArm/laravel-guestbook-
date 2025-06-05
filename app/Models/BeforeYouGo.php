<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeforeYouGo extends Model
{
    protected $fillable = ['property_id', 'content'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
