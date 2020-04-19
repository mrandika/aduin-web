<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceHandler extends Model
{
    protected $table = 'instance_handlers';
    protected $fillable = ['users_id', 'instances_id'];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'users_id');
    }

    public function instance()
    {
        return $this->belongsTo(\App\Model\Master\Instance\Instance::class, 'instances_id');
    }
}
