<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ["name" , "description" , "status"];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
