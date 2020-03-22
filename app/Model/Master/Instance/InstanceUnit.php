<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceUnit extends Model
{
    protected $table = 'instance_units';
    protected $fillable = ['instances_id', 'instance_types_id', 'instance_services_id', 'm_zone_provinces_id', 'm_zone_districts_id', 'm_zone_subdistricts_id', 'users_id', 'name', 'address'];

    public function reports()
    {
        return $this->hasMany(Report::class, 'instance_units_id');
    }

    public function instance()
    {
        return $this->belongsTo(Instance::class, 'instances_id');
    }

    public function type()
    {
        return $this->belongsTo(InstanceType::class, 'instance_types_id');
    }

    public function service()
    {
        return $this->belongsTo(InstanceService::class, 'instance_services_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'm_zone_provinces_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'm_zone_districts_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class, 'm_zone_subdistricts_id');
    }
}
