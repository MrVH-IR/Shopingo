<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function readAll()
    {
        $notifications = \App\Models\Notification::all();
        foreach ($notifications as $notification) {
            $notification->read_at = now();
            $notification->save();
        }
    }
}
