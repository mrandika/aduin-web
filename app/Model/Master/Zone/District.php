<?php

namespace App\Model\Master\Zone;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'm_zone_districts';
    protected $fillable = ['m_zone_provinces_id', 'index', 'name'];

    public $timestamps = false;

    public function provinces()
    {
        return $this->belongsTo(Province::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class);
    }
}
