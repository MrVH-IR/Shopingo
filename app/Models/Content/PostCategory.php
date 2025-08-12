<?php

namespace App\Models\Content;

use Database\Factories\Content\PostCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = ['name', 'description' , 'slug' , 'image' , 'status', 'tags'];

    public function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }
}
