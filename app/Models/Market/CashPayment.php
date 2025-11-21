<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashPayment extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = ["amount" , "user_id" , "cash_receiver" , "pay_date" , "status"];

    public function payment()
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }
}
