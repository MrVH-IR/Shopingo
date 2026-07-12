<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{

    public function index() : View
    {
        dd(auth()->user()->permissions());
        return view('admin.index');
    }
}
