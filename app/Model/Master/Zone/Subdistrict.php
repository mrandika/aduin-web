<?php

namespace App\Model\Master\Zone;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'm_zone_subdistricts';
    protected $fillable = ['m_zone_provinces_id', 'm_zone_districts_id', 'index', 'name'];

    public $timestamps = false;

    public function provinces()
    {
        return $this->belongsTo(Province::class);
    }

    public function districts()
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
