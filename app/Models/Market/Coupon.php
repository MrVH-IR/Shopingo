<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $fillable = ["code" , "amount" , "amount_type" , "discount_ceiling" , "type" , "status" , "start_date" , "end_date" , "user_id"];

    protected function casts(): array
    {
        return [
            "start_date" => "datetime",
            "end_date" => "datetime",
        ];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
