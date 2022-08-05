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

    public $timestamps = false;

    const ROLE_ADMINISTRATOR = 'Administrator';
    const ROLE_OWNER = 'Owner';
    const ROLE_GUEST = 'Guest';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'first_name',
        'last_name',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'email',
        'remote_addr',
        'confirm_hash',
        'is_confirmed',
        'role',
        'OwnerId',
        'date_created',
        'HouseId',
        'Intro',
        'ShowOldSave',
        'AdminOwner',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
        'email_verified_at',
        'old_password',
        'remember_token',
        'current_team_id',
        'profile_photo_path',
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
            get: fn($value) => $value === self::ROLE_ADMINISTRATOR,
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
            get: fn($value) => $value === self::ROLE_OWNER,
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
            get: fn($value) => $value === self::ROLE_GUEST,
        );
    }

    /**
     * Concatenate first & last name.
     *
     * @return string
     */
    protected function getNameAttribute(): string
    {
        return trim("$this->first_name $this->last_name");
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=e8604c&background=e8604c70';
    }

    public function isRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Show additional schedule vacations screen.
     *
     * Use this option to control whether you prefer to update the calendar by clicking on the day or
     * by scheduling on the separate vacations screen. Using just the calendar is a lot easier, however,
     * if you are using an older browser this functionality may not work to your liking.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function ShowOldSave(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value === 'Y',
            set: fn($value) => (int) $value === 1 ? 'Y' : 'N',
        );
    }

    /**
     * Allow administrator to have Owner permissions
     *
     * Use this option to control whether the admin will also have the ability to schedule vacations.
     * The only reason not do this is in the case that a vacation home has a person who is purely the
     * administrator and doesn't schedule time using the vacation home.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function AdminOwner(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value === 'Y',
            set: fn($value) => (int) $value === 1 ? 'Y' : 'N',
        );
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
    }
}
