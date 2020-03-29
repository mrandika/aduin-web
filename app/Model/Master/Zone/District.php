<?php

namespace App\Model\Master\Zone;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'm_zone_districts';
    protected $fillable = ['m_zone_provinces_id', 'index', 'name'];

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(App\Model\Master\Zone\Province::class, 'm_zone_provinces_id');
    }

    public function subdistricts()
    {
        return $this->hasMany(App\Model\Master\Zone\Subdistrict::class, 'm_zone_districts_id');
    }

    public function instances()
    {
        return $this->hasMany(App\Model\Master\Zone\Instance::class, 'm_zone_districts_id');
    }

    public function units()
    {
        return $this->hasMany(App\Model\Master\Zone\InstanceUnit::class, 'm_zone_districts_id');
    }
}
