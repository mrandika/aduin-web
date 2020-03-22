<?php

namespace App\Model\Master\Zone;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'm_zone_subdistricts';
    protected $fillable = ['m_zone_provinces_id', 'm_zone_districts_id', 'index', 'name'];

    public $timestamps = false;

    public function province()
    {
        return $this->belongsTo(Province::class, 'm_zone_provinces_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'm_zone_districts_id');
    }

    public function instances()
    {
        return $this->hasMany(Instance::class, 'm_zone_subdistricts_id');
    }

    public function units()
    {
        return $this->hasMany(InstanceUnit::class, 'm_zone_subdistricts_id');
    }
}
