<?php

namespace Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class UserCyberData extends Model {

    protected $table = "users_cyber_data";

    protected $fillable = [
        'ip_address',
        'header',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'header' => 'array'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}