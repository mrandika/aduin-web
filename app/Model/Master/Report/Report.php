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

    public function scopeUnhandled($query)
    {
        return $query->where('status', 1);
    }

    public function scopeHandled($query)
    {
        return $query->where('status', 2);
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 3);
    }

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRelation($query)
    {
        return $query->with(['user', 'instance', 'unit'])->withCount(['comments', 'actions', 'supports']);
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeSearchQuery($query, $keyword)
    {
        return $query->where('title', 'like', "%" . $keyword . "%");
    }

    public function scopeSearchCode($query, $code)
    {
        $full_code = explode('-', $code);

        try {
            $id_report = $full_code[1];
            $id_user = $full_code[2];

            return $query->where(['id' => $id_report, 'users_id' => $id_user])->first();
        } catch (\ErrorException $err) {
            return abort(404);
        }
    }

    public function actions()
    {
        return $this->hasMany(\App\Model\Master\Report\ReportAction::class, 'reports_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Model\Master\Report\ReportComment::class, 'reports_id');
    }

    public function handlers()
    {
        return $this->hasMany(\App\Model\Master\Report\ReportHandler::class, 'reports_id');
    }

    public function supports()
    {
        return $this->hasMany(\App\Model\Master\Report\ReportSupport::class, 'reports_id');
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
