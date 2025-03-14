<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActiveProduct extends Model
{
    protected $fillable = ['name' , 'description' , 'price' , 'stock',
    'image_uri' ,'category_id' , 'home_product_id'];

    public function category() {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function products() {
        return $this->hasMany('App\Models\HomeProduct','home_product_id');
    }
}
