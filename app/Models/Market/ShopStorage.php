<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;

class ShopStorage extends Model
{
    protected $fillable = ["deliverer", "receiver" , "description" , "product_id"];
}
