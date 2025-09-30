<?php

namespace App\Models\Ticket;

use App\Models\Content\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\Ticket\TicketFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = [
        "subject" ,
        "description" ,
        "status" ,
        "seen" ,
        "reference_id" ,
        "user_id" ,
        "category_id" ,
        "priority_id" ,
        "ticket_id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class , 'reference_id');
    }

    public function parent()
    {
        return $this->belongsTo(Ticket::class , 'ticket_id');
    }

    public function children()
    {
        return $this->hasMany(Ticket::class , 'ticket_id');
    }
}
