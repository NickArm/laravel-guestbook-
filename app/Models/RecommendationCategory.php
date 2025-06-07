<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendationCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'category_id');
    }
}
//
