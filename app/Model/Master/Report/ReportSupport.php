<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class ReportSupport extends Model
{
    protected $table = 'report_supports';
    protected $fillable = ['reports_id', 'users_id'];

    public function scopeReportId($id)
    {
        return $query->where('reports_id', $id);
    }

    public function report()
    {
        return $this->belongsTo(App\Model\Master\Report\Report::class, 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(App\User::class, 'users_id');
    }
}
