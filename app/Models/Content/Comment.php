<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = [
        'body'           ,
        'seen'           ,
        'approved'       ,
        'status'         ,
        'parent_id'      ,
        'author_id'      ,
        'commentable_id' ,
        'commentable_type'
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getApprovedLabelAttribute(): string
    {
        return $this->approved ? "تایید شده" : "تایید نشده";
    }

    public function getSeenLabelAttribute(): string
    {
        return $this->seen ? "دیده شده" : "دیده نشده";
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
