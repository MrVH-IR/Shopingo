<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmazingSale extends Model
{
    use SoftDeletes;

    protected $fillable = ["product_id" , "percentage" , "status" , "start_at" , "end_at"];

    protected function casts(): array
    {
        return [
          "start_at" => "datetime",
          "end_at" => "datetime",
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
