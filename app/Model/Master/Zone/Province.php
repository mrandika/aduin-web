<?php

namespace App\Model\Master\Zone;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'm_zone_provinces';
    protected $fillable = ['index', 'name'];

    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(App\Model\Master\Zone\District::class, 'm_zone_provinces_id');
    }

    public function subdistricts()
    {
        return $this->hasMany(App\Model\Master\Zone\Subdistrict::class, 'm_zone_provinces_id');
    }

    public function instances()
    {
        return $this->hasMany(App\Model\Master\Zone\Instance::class, 'm_zone_provinces_id');
    }

    public function units()
    {
        return $this->hasMany(App\Model\Master\Zone\InstanceUnit::class, 'm_zone_provinces_id');
    }
}
