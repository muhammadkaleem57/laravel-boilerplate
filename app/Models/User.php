<?php

namespace App\Models;

use App\Concerns\Logs;
use App\Concerns\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use UUID;
    use SoftDeletes;
    use Logs;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url', 'full_name'
    ];

    protected static function booted()
    {
        parent::booted();

        self::creating(function (User $user){
            if (!$user->uuid)
                $user->uuid = (new User())->generateUUId($user);

            $user->verification_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        });

        User::observe(\App\Observers\UserObserver::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? url('/storage/'.$this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl(): string
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getFullNameAttribute(): string
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin === YES;
    }

    public function isAdmin(): bool
    {
        return (int)$this->type === ADMIN;
    }

    public function isUser(): bool
    {
        return $this->type === USER;
    }

    public function isActive(): bool
    {
        return (int)$this->is_active === YES;
    }

    public function isOnline(): bool
    {
        return (int)$this->is_online === YES;
    }

    public function isAccountVerified(): bool
    {
        return !($this->email_verified_at === null);
    }
}
