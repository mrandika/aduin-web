<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class ReportSupport extends Model
{
    protected $table = 'report_supports';
    protected $fillable = ['reports_id', 'users_id'];

    public function report()
    {
        return $this->belongsTo(Report::class, 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
