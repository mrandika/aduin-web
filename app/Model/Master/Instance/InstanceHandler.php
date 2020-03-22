<?php

namespace App\Model\Master\Instance;

use Illuminate\Database\Eloquent\Model;

class InstanceHandler extends Model
{
    protected $table = 'instance_handlers';
    protected $fillable = ['users_id', 'instances_id'];
}
