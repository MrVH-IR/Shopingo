<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\AdminDashboardService;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index(AdminDashboardService $adminDashboardService): View
    {
        $stats = $adminDashboardService->stats();

        return view('admin.index', compact('stats'));
    }
}
