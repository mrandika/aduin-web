<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceType extends Model
{
    protected $table = 'm_data_instance_types';
    protected $fillable = ['index', 'name'];

    public $timestamps = false;

    public function instances()
    {
        return $this->hasMany(App\Model\Master\Instance\Instance::class, 'instance_types_id');
    }

    public function units()
    {
        return $this->hasMany(App\Model\Master\Instance\InstanceUnit::class, 'instance_units_id');
    }
}
