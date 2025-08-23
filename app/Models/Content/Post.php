<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['title', 'slug', 'summary', 'body', 'image', 'status', 'commentable' , 'tags'
    , 'published_at' , 'author_id' , 'category_id'];

    public function category()
    {
        return $this->belongsTo(PostCategory::class , 'category_id' , 'id');
    }

    public function casts(): array
    {
        return [
            'image' => 'array'
        ];
    }
}
