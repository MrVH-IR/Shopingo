@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>سفارشات</title>
@endsection

@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">

                @include('customer.layouts.aside')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>تاریخچه سفارشات</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->


                        <section class="d-flex justify-content-center my-4">
                            <a class="btn btn-outline-info" href="{{ route('customer.profile.orders') }}">همه</a>
                            <a class="btn btn-info btn-sm mx-1" href="{{ route('customer.profile.orders', ['type' => 0]) }}">بررسی نشده</a>
                            <a class="btn btn-warning btn-sm mx-1" href="{{ route('customer.profile.orders', ['type' => 1]) }}">در انتظار تایید</a>
                            <a class="btn btn-success btn-sm mx-1" href="{{ route('customer.profile.orders', ['type' => 2]) }}">تایید نشده</a>
                            <a class="btn btn-danger btn-sm mx-1" href="{{ route('customer.profile.orders', ['type' => 3]) }}">تایید شده</a>
                            <a class="btn btn-dark btn-sm mx-1" href="{{ route('customer.profile.orders', ['type' => 4]) }}">لغو باطل شده</a>
                            <a class="btn btn-outline-secondary" href="{{ route('customer.profile.orders', ['type' => 5]) }}">مرجوع شده</a>
                        </section>

                        <!-- start content header -->
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    در انتظار پرداخت
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end content header -->


                        <section class="order-wrapper">
                            @forelse($orders as $order)
                            <section class="order-item">
                                <section class="d-flex justify-content-between">
                                    <section>
                                        <section class="order-item-date"><i class="fa fa-calendar-alt"></i>  {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at)->format('Y/m/d H:i:s') }}</section>
                                        <section class="order-item-id"><i class="fa fa-id-card-alt"></i>کد سفارش : {{ $order->id }}</section>
                                        <section class="order-item-status"><i class="fa fa-clock"></i> {{ $order->payment_status_value }}</section>
                                        <section class="order-item-products">
                                            <img src="{{ asset($order->orderItems?->first()?->product['image']['indexArray']['small']) }}" alt="عکس موجود نیست">
                                        </section>
                                    </section>
                                    <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                                </section>
                            </section>
                            @empty
                                <section class="order-item">
                                    <p class="text-center text-black">شما هیچ سفارشی ندارید.</p>
                                </section>
                            @endforelse
                        </section>


                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
