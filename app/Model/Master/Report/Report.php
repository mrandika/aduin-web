<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = ['users_id', 'instance_units_id', 'title', 'content', 'seen_count', 'status'];

    public function actions()
    {
        return $this->hasMany(ReportAction::class, 'reports_id');
    }

    public function comments()
    {
        return $this->hasMany(ReportComment::class, 'reports_id');
    }

    public function handlers()
    {
        return $this->hasMany(ReportHandler::class, 'reports_id');
    }

    public function supports()
    {
        return $this->hasMany(ReportSupport::class, 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function unit()
    {
        return $this->belongsTo(InstanceUnit::class, 'instance_units_id');
    }
}
