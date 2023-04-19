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
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use AuditableTrait;

    const ROLE_SUPERADMIN = 'SuperAdmin';
    const ROLE_ADMINISTRATOR = 'Administrator';
    const ROLE_OWNER = 'Owner';
    const ROLE_GUEST = 'Guest';

    public $user_ad = null;

    const PAYPAL_PRODUCT_ID = 'PROD-5NU26276VJ273353M';

    /**
     * Attribute modifiers.
     *
     * @var array
     */
    protected $attributeModifiers = [

    ];

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
        'primary_account',
        'parent_id',
        'role',
        'OwnerId',
        'date_created',
        'HouseId',
        'Intro',
        'ShowOldSave',
        'AdminOwner',
        'enable_rooms',
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
        'is_confirmed',
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
     * @return mixed
     */
    protected function getIsSuperAdminAttribute(): bool
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    /**
     * Check user is admin.
     *
     * @return mixed
     */
    protected function getIsAdminAttribute(): bool
    {
        return $this->role === self::ROLE_ADMINISTRATOR;
    }

    /**
     * Check user is owner.
     *
     * @return mixed
     */
    protected function getIsOwnerAttribute(): bool
    {
        return $this->role === self::ROLE_OWNER || ($this->is_admin && $this->AdminOwner);
    }

    /**
     * Check user is owner.
     *
     * @return mixed
     */
    protected function getIsOwnerOnlyAttribute(): bool
    {
        return $this->role === self::ROLE_OWNER;
    }

    /**
     * Check user is guest.
     *
     * @return mixed
     */
    protected function getIsGuestAttribute(): string
    {
        return $this->role === self::ROLE_GUEST;
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

        return asset('default-profile-photo.svg');
    }

    /**
     * Check for specific role
     * @param $role
     * @return bool
     */
    public function isRole($role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if guest account already exists
     * @return mixed
     */
    public function hasGuest(): bool
    {
        return User::where('HouseId', $this->HouseId)->where('role', self::ROLE_GUEST)->exists();
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
            set: fn($value) => (int)$value === 1 ? 'Y' : 'N',
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
            set: fn($value) => (int)$value === 1 ? 'Y' : 'N',
        );
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'HouseId', 'HouseID');
    }

    public function primaryUser()
    {
        return $this->belongsTo(self::class, 'parent_id', 'user_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function getAdditionalHousesAttribute()
    {
        $user = auth()->user();
        if ($user->role === 'Owner'){
//            $this->user_ad = User::where('parent_id', $user->parent_id)->where('role', 'Owner')->first();
            $this->user_ad = $user;
            return House::whereHas('users', function ($query) {
                $query->where([
                    'role' => self::ROLE_OWNER,
                    ['HouseId', '<>', $this->user_ad->HouseId],
                    'parent_id' =>  $this->user_ad->parent_id
                ]);
            })->get();
        }
        elseif ($user->role === 'Administrator'){
            return House::whereHas('users', function ($query) {
                $query->where([
                    'role' => self::ROLE_ADMINISTRATOR,
                    ['HouseId', '<>', $this->HouseId]
                ])->where(function ($query) {
                    $query->where('email', $this->email)
                        ->when($this->primary_account, function ($query) {
                            $query->orWhere('parent_id', $this->user_id);
                        })
                        ->when(!$this->primary_account, function ($query) {
                            $query->orWhere(function ($query) {
                                $query->where('parent_id', $this->user_id)
                                    ->orWhere('user_id', $this->user_id);
                            });
                        });
                });
            })->get();

        }
    }

    public function ical()
    {
        return $this->hasOne(ICal::class, 'user_id', 'user_id');
    }

    public function iCalUrl()
    {
        $ical = $this->ical;
        if (!$ical) {
            $this->ical()->save($ical = new ICal([
                'house_id' => $this->HouseId,
                'slug' => strtolower(uniqid() . $this->HouseId . time() . $this->user_id),
            ]));
        }

        return route('guest.ical', $ical);
    }


    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'user_id',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'remote_addr',
        'parent_id',
        'confirm_hash',
//        'is_confirmed',
//        'role',
        'OwnerId',
        'date_created',
        'HouseId',
//        'HouseId',
        'Intro',
        'ShowOldSave',
        'AdminOwner',
        'enable_rooms',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
        'email_verified_at',
        'old_password',
        'remember_token',
        'current_team_id',
        'is_confirmed',
    ];

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id', 'user_id')->where('house_id', $this->HouseId)->where('status', 'ACTIVE');
    }

}
