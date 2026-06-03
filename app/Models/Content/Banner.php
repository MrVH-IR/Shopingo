<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    protected function casts(): array
    {
        return [
            "image" => "array"
        ];
    }

    protected $fillable = [
        "title" , "image" , "link" , "position" , "status"
    ];

    public static $position = [
        0 => "اسلاید شو (صفحه اصلی)",
        1 => "کنار اسلاید شو (صفحه اصلی)",
        2 => "دو بنر تبلیغی بین دو اسلاید (صفحه اصلی)",
        3 => "بنر تبلیغی بزرگ پایین دو اسلایدر (صفحه اصلی)",
    ];
}
