<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    protected $table = 'instances';
    protected $fillable = ['instance_types_id', 'instance_services_id', 'm_zone_provinces_id', 'm_zone_districts_id', 'm_zone_subdistricts_id', 'users_id', 'name', 'address'];

    public function units()
    {
        return $this->hasMany(App\Model\Master\Instance\InstanceUnit::class, 'instances_id');
    }

    public function handlers()
    {
        return $this->hasMany(App\Model\Master\Instance\InstanceHandler::class, 'instances_id');
    }

    public function bins()
    {
        return $this->hasMany(App\Model\Master\Report\ReportBin::class, 'instances_id');
    }
    
    public function type()
    {
        return $this->belongsTo(App\Model\Master\Instance\InstanceType::class, 'instance_types_id');
    }

    public function service()
    {
        return $this->belongsTo(App\Model\Master\Instance\InstanceService::class, 'instance_services_id');
    }

    public function province()
    {
        return $this->belongsTo(App\Model\Master\Zone\Province::class, 'm_zone_provinces_id');
    }

    public function district()
    {
        return $this->belongsTo(App\Model\Master\Zone\District::class, 'm_zone_districts_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(App\Model\Master\Zone\Subdistrict::class, 'm_zone_subdistricts_id');
    }
}
