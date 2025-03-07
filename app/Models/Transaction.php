<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'payment_status', 'payment_method'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
