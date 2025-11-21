<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlinePayment extends Model
{
    use SoftDeletes;

    protected $fillable = ["amount" , "user_id" , "gateway" , "transaction_id" ,
        "bank_first_response" , "bank_second_response" , "status"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
