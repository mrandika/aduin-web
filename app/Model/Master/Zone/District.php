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
        return $this->belongsTo(Province::class, 'm_zone_provinces_id');
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class, 'm_zone_districts_id');
    }

    public function instances()
    {
        return $this->hasMany(Instance::class, 'm_zone_districts_id');
    }

    public function units()
    {
        return $this->hasMany(InstanceUnit::class, 'm_zone_districts_id');
    }
}
