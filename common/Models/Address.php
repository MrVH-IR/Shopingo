<?php

namespace Common\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = ["user_id" , "city_id" , "postal_code" , "address" , "no" , "unit"
    , "recipient_first_name" , "recipient_last_name" , "mobile" , "status"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
