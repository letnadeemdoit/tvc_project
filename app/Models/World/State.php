<?php

namespace App\Models\World;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'country_id',
        'country_code',
        'fips_code',
        'iso2',
        'type',
        'latitude',
        'longitude',
        'flag',
        'wikiDatald',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'flag' => 'boolean',
    ];

    /**
     * Belongs to Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
