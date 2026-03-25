<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'domain',
        'email',
        'phone',
        'logo',
        'favicon',
        'plan_id',
        'plan_expires_at',
        'trial_ends_at',
        'created_by',
        'status',
    ];

    protected $casts = [
        'plan_expires_at' => 'datetime',
        'trial_ends_at'   => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Tenant $tenant) {
            if (empty($tenant->uuid)) {
                $tenant->uuid = Str::uuid()->toString();
            }
        });
    }

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }

    public function admins()
    {
        return $this->hasMany(User::class, 'tenant_id')->where('role', USER_ROLE_ADMIN);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class, 'tenant_id');
    }

    public function isSubscriptionActive(): bool
    {
        if (is_null($this->plan_expires_at)) {
            return false;
        }
        return $this->plan_expires_at->isFuture();
    }

    public function isTrial(): bool
    {
        if (is_null($this->trial_ends_at)) {
            return false;
        }
        return $this->trial_ends_at->isFuture();
    }

    public function isActive(): bool
    {
        return $this->status === TENANT_STATUS_ACTIVE;
    }

    public function scopeActive($query)
    {
        return $query->where('status', TENANT_STATUS_ACTIVE);
    }
}
