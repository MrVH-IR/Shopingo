<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfflinePayment extends Model
{
    use SoftDeletes;

    protected $fillable = ["amount" , "user_id" , "transaction_id" , "paid_date" , "status"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function transaction()
//    {
//        return $this->belongsTo(Transaction::class);
//    }
}
