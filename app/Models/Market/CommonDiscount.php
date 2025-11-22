<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonDiscount extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            "start_at" => "datetime",
            "end_at" => "datetime",
        ];
    }

    protected $fillable = ["title" , "discount" , "discount_ceiling" , "discount_floor" , "status" , "start_at" , "end_at"];
}
