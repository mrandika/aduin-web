<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceService extends Model
{
    protected $table = 'instance_services';
    protected $fillable = ['index', 'name'];

    public function instances()
    {
        return $this->hasMany(Instance::class, 'instance_services_id');
    }

    public function units()
    {
        return $this->hasMany(InstanceUnit::class, 'instance_services_id');
    }
}
