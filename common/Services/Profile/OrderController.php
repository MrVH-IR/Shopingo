<?php

namespace Common\Services\Profile;

class OrderController extends BaseController
{

    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->when(request()->has('type'), function ($query) {
                $query->where('order_status', request('type'));
            })
            ->latest()
            ->get();
        return view('customer.profile.orders', compact('orders'));
    }
}
