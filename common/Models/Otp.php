<?php

namespace Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otp extends Model
{


    protected $fillable = [
        'user_id',
        'token',
        'type',
        'status',
        'used',
        'login_id',
        'otp_code'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
