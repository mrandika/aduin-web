<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceService extends Model
{
    protected $table = 'm_data_instance_services';
    protected $fillable = ['index', 'name'];

    public $timestamps = false;

    public function instances()
    {
        return $this->hasMany(\App\Model\Master\Instance\Instance::class, 'instance_services_id');
    }

    public function units()
    {
        return $this->hasMany(\App\Model\Master\Instance\InstanceUnit::class, 'instance_services_id');
    }
}
