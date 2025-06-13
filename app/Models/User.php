<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasUuids, LogsActivity;

    protected static $logAttributes = ['name', 'email', 'is_active'];

    protected static $logName = 'user';

    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'photo',
        'bio',
        'address',
        'mobile_number',
        'contact_me',
        'property_limit',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'contact_me' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'is_active'])
            ->useLogName('user')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
