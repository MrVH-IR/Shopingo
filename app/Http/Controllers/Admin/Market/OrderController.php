<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function all()
    {
        $orders = Order::simplePaginate(10);
        return view('admin.market.order.index' , compact('orders'));
    }

    public function newOrders()
    {
        return view('admin.market.order.index');
    }
    public function sending()
    {
        return view('admin.market.order.index');
    }
    public function unpaid()
    {
        return view('admin.market.order.index');
    }
    public function cancele()
    {
        return view('admin.market.order.index');
    }
    public function returned()
    {
        return view('admin.market.order.index');
    }
    public function show()
    {
        return view('admin.market.order.index');
    }
    public function changeSendStatus()
    {
        return view('admin.market.order.index');
    }
    public function changeOrderStatus()
    {
        return view('admin.market.order.index');
    }
    public function cancelOrder()
    {
        return view('admin.market.order.index');
    }
}
