<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'house_id',
        'slug'
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function userVacations()
    {
        return $this->hasMany(Vacation::class, 'house_id', 'HouseID')->where('OwnerId', $this->user_id);
    }

    public function houseVacations()
    {
        return $this->hasMany(Vacation::class, 'house_id', 'HouseID');
    }
}
