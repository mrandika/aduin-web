<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class ReportHandler extends Model
{
    protected $table = 'report_handlers';
    protected $fillable = ['reports_id', 'users_id'];

    public function report()
    {
        return $this->belongsTo(Report::class, 'reports_id');
    }

    public function handler()
    {
        return $this->belongsTo(InstanceHandler::class, 'instance_unit_handlers_id');
    }
}
