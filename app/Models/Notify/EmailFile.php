<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailFile extends Model
{
    use SoftDeletes;

    protected $table = 'public_mail_files';

    protected $fillable = ["public_mail_id" , "file_path" , "file_size" , "file_type" , "status"];

    public function mail(): BelongsTo
    {
        return $this->belongsTo(Email::class, 'public_mail_id', 'id');
    }
}
