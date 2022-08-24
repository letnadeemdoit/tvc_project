<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenityType extends Model
{
    use HasFactory;

    protected $table = 'AmenityType';

    protected $primaryKey = 'AmenityID';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'AmenityID',
        'AmenityName',
        'Abreviation',
    ];
}
