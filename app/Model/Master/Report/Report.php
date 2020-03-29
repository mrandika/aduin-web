<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = ['users_id', 'instances_id', 'instance_units_id', 'title', 'content', 'seen_count', 'status'];

    public function scopeActive($query)
    {
        return $query->where('status', '>', 0);
    }

    public function actions()
    {
        return $this->hasMany(App\Model\Master\Report\ReportAction::class, 'reports_id');
    }

    public function comments()
    {
        return $this->hasMany(App\Model\Master\Report\ReportComment::class, 'reports_id');
    }

    public function handlers()
    {
        return $this->hasMany(App\Model\Master\Report\ReportHandler::class, 'reports_id');
    }

    public function supports()
    {
        return $this->hasMany(App\Model\Master\Report\ReportSupport::class, 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'users_id');
    }

    public function instance()
    {
        return $this->belongsTo(\App\Model\Master\Instance\Instance::class, 'instances_id');
    }

    public function unit()
    {
        return $this->belongsTo(\App\Model\Master\Instance\InstanceUnit::class, 'instance_units_id');
    }
}
