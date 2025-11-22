<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfflinePayment extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = ["amount" , "user_id" , "transaction_id" , "paid_date" , "status"];

    protected function casts(): array
    {
        return [
            "paid_date" => "datetime",
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

//    public function transaction()
//    {
//        return $this->belongsTo(Transaction::class);
//    }
}
