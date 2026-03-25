<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'tenant_id',
        'role',
        'email_verified_at',
        'password',
        'email_verification_status',
        'phone_verification_status',
        'verify_token',
        'otp',
        'otp_expiry',
        'google_auth_status',
        'google2fa_secret',
        'google_id',
        'facebook_id',
        'image',
        'last_seen',
        'show_email_in_public',
        'show_phone_in_public',
        'created_by',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen'         => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (in_array('uuid', $model->getFillable()) && empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === USER_ROLE_SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === USER_ROLE_ADMIN;
    }

    public function unseen_message()
    {
        return $this->hasMany(Chat::class, 'sender_id')->where(['is_seen' => STATUS_PENDING]);
    }

    public function messages()
    {
        return $this->hasMany(Chat::class, 'receiver_id')->where('sender_id', auth()->id());
    }

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid = Str::uuid()->toString();
        });
    }
}