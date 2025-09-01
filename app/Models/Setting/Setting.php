<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ["title" , "description" , "keywords" , "logo" , "favicon" ];

    protected $casts = [
        "logo" => "array",
        "favicon" => "array"
    ];
}
