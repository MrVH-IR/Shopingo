<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [ "name" , "url" , "status" , "parent_id" ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class , 'parent_id');
    }
}
