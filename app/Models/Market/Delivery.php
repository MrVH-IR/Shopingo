<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
        'delivery_time',
        'delivery_time_unit',
        'status',
    ];

    public function getDeliveryTimeAttribute()
    {
        $delivery_time = $this->attributes['delivery_time'];
        $delivery_time_unit = $this->attributes['delivery_time_unit'];
        return $delivery_time . ' ' . $delivery_time_unit;
    }
}
