<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'avk_districtID', "province_id"];
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function ward()
    {
        return $this->hasMany(Ward::class);
    }
}
