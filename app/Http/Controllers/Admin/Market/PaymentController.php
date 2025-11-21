<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index()
    {
        $allPayments = Payment::simplePaginate(10);
        return view('admin.market.payment.index' , compact('allPayments'));
    }

    public function online()
    {
        return view('admin.market.payment.index');
    }
    public function offline()
    {
        return view('admin.market.payment.index');
    }

    public function attendance()
    {
        return view('admin.market.payment.index');
    }

    public function confirm()
    {
        return view('admin.market.payment.index');
    }
}
