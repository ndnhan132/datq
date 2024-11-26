<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name', 'avk_provinceID'];
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
