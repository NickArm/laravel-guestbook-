<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplianceImage extends Model
{
    use HasFactory;

    protected $fillable = ['appliance_id', 'url', 'public_id'];

    public function appliance()
    {
        return $this->belongsTo(Appliance::class);
    }
}
