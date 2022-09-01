<?php

namespace App\Models\World;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'iso3',
        'numeric_code',
        'iso2',
        'phonecode',
        'capital',
        'currency',
        'currency_name',
        'currency_symbol',
        'tld',
        'native',
        'region',
        'subregion',
        'timezones',
        'translations',
        'latitude',
        'longitude',
        'emoji',
        'emojiU',
        'flag',
        'wikiDatald',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'timezones' => 'array',
        'translations' => 'array',
        'flag' => 'boolean',
    ];
}
