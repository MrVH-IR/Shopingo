@extends('admin.layouts.master')


@section('head-tag')
<title>فاکتور سفارش</title>
<style>
    .invoice-container {
        background: #fff;
        padding: 24px;
        border-radius: 12px;
        font-size: 14px;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px dashed #ddd;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }

    .invoice-card {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 16px;
    }

    .invoice-title {
        font-weight: bold;
        margin-bottom: 12px;
        color: #333;
    }

    .invoice-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px 20px;
    }

    .invoice-grid div span {
        color: #777;
        margin-left: 6px;
    }

    .invoice-grid .full {
        grid-column: 1 / -1;
    }

    .invoice-grid .highlight {
        font-weight: bold;
        color: #198754;
    }

    .invoice-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 12px;
        color: #555;
    }

    /* Print */
    @media print {
        body {
            background: #fff;
        }

        .btn {
            display: none !important;
        }
    }
</style>
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
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
           فاکتور
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        فاکتور
                    </h5>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px" id="printable">
                        <div class="invoice-container" id="printable">

                            <div class="invoice-header">
                                <a href="{{ route('admin.market.order.showDetail' , $order->id) }}">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fa fa-book"></i> جزئیات
                                    </button>
                                </a>
                                <div>
                                    <h4>فاکتور سفارش #{{ $order->id }}</h4>
                                    <span class="text-muted">تاریخ ثبت سفارش:
                                        {{ \Morilog\Jalali\Jalalian::fromCarbon($order->created_at) }}
                                    </span>
                                </div>

                                <button class="btn btn-dark btn-sm" id="print">
                                    <i class="fa fa-print"></i> چاپ فاکتور
                                </button>
                            </div>

                            {{-- User & Address --}}
                            <div class="invoice-card">
                                <h6 class="invoice-title">اطلاعات گیرنده</h6>
                                <div class="invoice-grid">
                                    <div><span>نام:</span> {{ $order->address->recipient_first_name ?? '-' }}</div>
                                    <div><span>نام خانوادگی:</span> {{ $order->address->recipient_last_name ?? '-' }}</div>
                                    <div><span>موبایل:</span> {{ $order->address->mobile ?? '-' }}</div>
                                    <div><span>کد پستی:</span> {{ $order->address->postal_code ?? '-' }}</div>
                                    <div class="full">
                                        <span>آدرس:</span>
                                        {{ $order->address->address ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-card">
                                <h6 class="invoice-title">اطلاعات پرداخت</h6>
                                <div class="invoice-grid">
                                    <div><span>نوع پرداخت:</span> {{ $order->payment_type_text }}</div>
                                    <div><span>وضعیت پرداخت:</span> {{ $order->payment_status_text }}</div>
                                    <div><span>بانک:</span> {{ $order->payment->paymentable->gateway ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="invoice-card">
                                <h6 class="invoice-title">مبالغ</h6>
                                <div class="invoice-grid">
                                    <div><span>مبلغ سفارش:</span> {{ number_format($order->order_final_amount) }}</div>
                                    <div><span>تخفیف:</span> {{ number_format($order->order_discount_amount) }}</div>
                                    <div class="highlight">
                                        <span>مبلغ نهایی:</span>
                                        {{ number_format($order->order_final_amount - $order->order_discount_amount) }}
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-footer d-none" id="printDate">
                                تاریخ چاپ فاکتور:
                                {{ \Morilog\Jalali\Jalalian::fromCarbon(now()) }}
                            </div>

                        </div>

                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection

@section('script')
            <script>
                var printBtn = document.getElementById('print');
                printBtn.addEventListener('click' , function () {
                    printContent('printable');
                });

                function printContent(el) {
                    var printDate = document.getElementById('printDate');
                    printDate.classList.remove('d-none');
                    var restorePage = $('body').html();
                    var printContent = $('#' + el).clone();
                    $('body').empty().html(printContent);
                    window.print();
                    $('body').html(restorePage);
                }
            </script>
@endsection
