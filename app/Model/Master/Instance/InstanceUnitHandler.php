<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceUnitHandler extends Model
{
    protected $table = 'instance_unit_handlers';
    protected $fillable = ['users_id', 'instance_units_id'];
}
