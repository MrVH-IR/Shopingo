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
        return view('admin.market.order.index' , compact('orders'))
            ->with('swal-success', 'سفارش‌های جدید با موفقیت بررسی شدند.');
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
    public function show(Order $order)
    {
        return view('admin.market.order.show' , compact('order'));
    }
    public function changeSendStatus(Order $order)
    {
        $order->delivery_status = match ($order->delivery_status) {
            0 => 1,
            1 => 2,
            2 => 3,
            default => 0
        };
        $order->save();
        return back()->with('swal-success', 'وضعیت ارسال سفارش با موفقیت تغییر کرد.');
    }
    public function changeOrderStatus(Order $order)
    {
        $order->order_status = match ($order->order_status) {
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
            5 => 6,
            default => 1
        };
        $order->save();
        return back()->with('swal-success', 'وضعیت سفارش با موفقیت تغییر کرد.');
    }
    public function cancelOrder(Order $order)
    {
        $order->order_status = 4;
        $order->save();
        return back()->with('swal-success', 'سفارش با موفقیت باطل شد.');
    }

    public function showDetail(Order $order)
    {
        return view('admin.market.order.detail' , compact('order'));
    }
}
