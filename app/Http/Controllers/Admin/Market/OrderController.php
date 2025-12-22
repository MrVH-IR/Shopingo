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
        $orders = Order::where('order_status' , 0)->simplePaginate(10);
        foreach ($orders as $order) {
            $order->order_status = 1;
            $order->save();
        }
        return view('admin.market.order.index' , compact('orders'));
    }
    public function sending()
    {
        $orders = Order::where('delivery_status' , 1)->simplePaginate(10);
        return view('admin.market.order.index' , compact('orders'));
    }
    public function unpaid()
    {
        $orders = Order::where('payment_status' , 0)->simplePaginate(10);
        return view('admin.market.order.index' , compact('orders'));
    }
    public function cancele()
    {
        $orders = Order::where('order_status' , 4)->simplePaginate(10);
        return view('admin.market.order.index' , compact('orders'));
    }
    public function returned()
    {
        $orders = Order::where('order_status' , 5)->simplePaginate(10);
        return view('admin.market.order.index' , compact('orders'));
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
