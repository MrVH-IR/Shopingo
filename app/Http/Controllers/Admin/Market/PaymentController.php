<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
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
        $allPayments = Payment::where('paymentable_type' , OnlinePayment::class)->simplePaginate(10);
        return view('admin.market.payment.index' , compact('allPayments'));
    }
    public function offline()
    {
        $allPayments = Payment::where('paymentable_type' , OfflinePayment::class)->simplePaginate(10);
        return view('admin.market.payment.index' , compact('allPayments'));
    }

    public function cash()
    {
        $allPayments = Payment::where('paymentable_type' , CashPayment::class)->simplePaginate(10);
        return view('admin.market.payment.index' , compact('allPayments'));
    }

    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success' , "تغییرات شما با موفقیت انجام شد");
    }

    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success' , "تغییرات شما با موفقیت انجام شد");
    }

    public function confirm(Payment $payment)
    {
        $payment->status = 1;
        $payment->save();
        return redirect()->route('admin.market.payment.index')->with('swal-success' , "تغییرات شما با موفقیت انجام شد");
    }

    public function show(Payment $payment)
    {
        return view('admin.market.payment.show' , compact('payment'));
    }

}
