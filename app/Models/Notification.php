<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ["type" , "notifiable_id" , "notifiable_type" , "data" , "read_at"];
    protected $guarded = ['id'];

    protected function casts()
    {
        return [
            "data" => "array",
        ];
    }
}
