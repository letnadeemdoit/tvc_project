<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestContact extends Model
{
    use HasFactory;

    protected $table = 'guest_contacts';

    protected $fillable = [
        'house_id',
        'guest_id',
        'guest_name',
        'guest_email',
        'guest_vac_id',
        'guest_vac_color',
        'is_approved',
    ];


    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'HouseId');
    }
}
