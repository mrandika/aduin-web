<?php

namespace App\Model\Master\Report;

use Illuminate\Database\Eloquent\Model;

class ReportHandler extends Model
{
    protected $table = 'report_handlers';
    protected $fillable = ['reports_id', 'instance_handlers_id', 'instance_unit_handlers_id'];

    public function report()
    {
        return $this->belongsTo(\App\Model\Master\Report\Report::class, 'reports_id');
    }

    public function handler()
    {
        return $this->belongsTo(\App\Model\Master\Instance\InstanceHandler::class, 'instance_handlers_id');
    }
}
