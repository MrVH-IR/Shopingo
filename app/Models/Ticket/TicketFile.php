<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class TicketFile extends Model
{

    protected $fillable = [
        'file_path',
        'file_size',
        'file_type',
        'ticket_id',
        'user_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
