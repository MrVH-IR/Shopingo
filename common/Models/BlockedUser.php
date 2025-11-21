<?php

namespace Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlockedUser extends Model
{

    protected $fillable = ["ip_address" , "mac_address" , "user_id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
