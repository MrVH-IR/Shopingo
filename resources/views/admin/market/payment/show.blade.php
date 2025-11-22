@extends('admin.layouts.master')


@section('head-tag')
<title>نمایش پرداخت</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.market.category.index') }}">بخش فروش</a>
        </li>
        <li class="breadcrumb-item font-size-12" aria-current="page">
            پرداخت
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            نمایش پرداخت
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش پرداخت
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-primary">
                        <p>{{ $payment->user?->fullName }} - {{ $payment->user?->mobile }}</p>
                    </section>
                    <section class="card-body">
                        <h5 class="card-title"> مبلغ پرداخت شده : {{ $payment->amount }}</h5>
                        <h5 class="card-title"> درگاه : {{ $payment->paymentable->gateway ?? " - "}}</h5>
                        <h5 class="card-title"> کد تراکنش : {{ $payment->paymentable->transaction_id ?? " - "}}</h5>
                        <h5 class="card-title"> تاریخ پرداخت : {{ $payment->paymentable->pay_date ?? " - "}}</h5>
                        <h5 class="card-title"> گیرنده : {{ $payment->paymentable->cash_receiver ?? " - "}}</h5>
                    </section>
                </section>
            </section>
        </section>
    </section>

@endsection
