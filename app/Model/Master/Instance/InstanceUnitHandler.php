<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceUnitHandler extends Model
{
    protected $table = 'instance_unit_handlers';
    protected $fillable = ['users_id', 'instance_units_id'];

    public function user()
    {
        return $this->belongsTo(App\User::class, 'users_id');
    }

    public function unit()
    {
        return $this->belongsTo(App\Model\Master\Instance\InstanceUnit::class, 'instance_units_id');
    }
}
