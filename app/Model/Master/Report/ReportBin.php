<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class ReportBin extends Model
{
    protected $table = 'report_bins';
    protected $fillable = ['users_id', 'instance_id', 'instance_units_id', 'title', 'content', 'seen_count', 'status'];

    public function user()
    {
        return $this->belongsTo(App\User::class, 'users_id');
    }

    public function instance()
    {
        return $this->belongsTo(App\Model\Master\Instance\Instance::class, 'instance_id');
    }

    public function unit()
    {
        return $this->belongsTo(App\Model\Master\Instance\InstanceUnit::class, 'instance_units_id');
    }
}
