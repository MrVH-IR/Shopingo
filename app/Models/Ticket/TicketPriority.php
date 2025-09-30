<?php

namespace App\Models\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketPriority extends Model
{
    use SoftDeletes;

    protected $fillable = ["name" , "status"];
}
