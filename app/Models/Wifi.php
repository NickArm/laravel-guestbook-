<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wifi extends Model
{
    use HasFactory;

    protected $fillable = ['network', 'password', 'description', 'property_id'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
