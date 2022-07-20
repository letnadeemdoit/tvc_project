<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_ADMINISTRATOR = 'Administrator';
    const ROLE_OWNER = 'Owner';
    const ROLE_GUEST = 'Guest';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Check user is admin.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value === self::ROLE_ADMINISTRATOR,
        );
    }

    /**
     * Check user is owner.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isOwner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value === self::ROLE_OWNER,
        );
    }

    /**
     * Check user is guest.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isGuest(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value === self::ROLE_GUEST,
        );
    }



    public function isRole($role) {
        return $this->role === $role;
    }

    public function house() {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
    }
}
