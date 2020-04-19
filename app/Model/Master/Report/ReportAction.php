<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class ReportAction extends Model
{
    protected $table = 'report_actions';
    protected $fillable = ['reports_id', 'users_id', 'content'];

    public function report()
    {
        return $this->belongsTo(\App\Model\Master\Report\Report::class, 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'users_id');
    }
}
