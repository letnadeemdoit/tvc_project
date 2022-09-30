<?php

namespace App\Models;

use App\Models\Photo\Photo;
use App\Models\Room\Room;
use App\Models\Traits\HasFile;
use App\Models\World\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class House extends Model
{
    use HasFactory;
    use HasFile;

    protected $table = 'House';

    protected $primaryKey = 'HouseID';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'HouseID',
        'image',
        'HouseName',
        'primary_house_name',
        'Address1',
        'Address2',
        'country',
        'City',
        'State',
        'ZipCode',
        'HomePhone',
        'Fax',
        'EmergencyPhone',
        'ReferredBy',
        'Status',
        'plan',
        'Guest',
        'CalEmailList',
        'BlogEmailList',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];

    /**
     * Get the URL to the file.
     *
     * @return string
     */
    public function getFileUrl($column = 'image')
    {
        if ($column === 'image') {
            if ($this->image === null) {
                $photos = $this->photos;
                if (count($photos) > 0) {
                    $photoPath = "photos/photo_".$this->HouseID."_".$photos[0]->PhotoId.".jpg";
                    if (Storage::disk($this->fileDisk())->exists($photoPath)) {
                        $this->{$column} = "photos/photo_".$this->HouseID."_".$photos[0]->PhotoId.".jpg";
                    }
                }
            }
        }

        return $this->{$column}
            ? Storage::disk($this->fileDisk())->url($this->{$column})
            : $this->defaultFileUrl($column);
    }

    public function getNameAttribute()
    {
        return $this->HouseName;
    }

    public function getAddressAttribute()
    {

        return implode(', ',  array_filter([$this->Address1, $this->Address2,$this->country,$this->State, $this->City, $this->ZipCode]));
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'HouseId', 'HouseID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'HouseId', 'HouseID');
    }


    /**
     * Attributes to exclude from the Audit.
     *
     * @var array
     */
    protected $auditExclude = [
        'HouseID',
        'plan',
        'Guest',
        'CalEmailList',
        'BlogEmailList',
        'Audit_user_name',
        'Audit_Role',
        'Audit_FirstName',
        'Audit_LastName',
        'Audit_Email',
    ];


    public function rooms() {
        return $this->hasMany(Room::class, 'HouseID', 'HouseID');
    }

    /**
     * {@inheritdoc}
     */
    public function transformAudit(array $data): array
    {


        if (Arr::has($data, 'new_values.category_id')) {

            $data['old_values']['category name'] = Category::find($this->getOriginal('category_id'));

            $data['new_values']['category name'] = $this->category->name;

        }

        return $data;
    }

}
