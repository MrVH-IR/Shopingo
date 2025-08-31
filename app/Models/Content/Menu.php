<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [ "name" , "url" , "status" , "parent_id" ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class , 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class , 'parent_id');
    }

    protected static function booted(): void
    {
        static::deleting(function ($menu) {
            if ($menu->isForceDeleting()) {
                $menu->children()->forceDelete();
            } else {
                $menu->children()->delete();
            }
        });

        static::restoring(function ($menu) {
            $menu->children()->withTrashed()->restore();
        });
    }
}
