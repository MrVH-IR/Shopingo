<?php

namespace Common\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name" , "province_id"
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
