@extends('admin.layouts.master')


@section('head-tag')
<title>سفارشات</title>
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
           سفارشات
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        سفارشات
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد برند</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <th>#</th>
                            <th>کد سفارش</th>
                            <th>مبلغ سفارش</th>
                            <th>مبلغ تخفیف</th>
                            <th>مبلغ نهایی</th>
                            <th>وضعیت پرداخت</th>
                            <th>شیوه پرداخت</th>
                            <th>بانک</th>
                            <th>وضعیت ارسال</th>
                            <th>شیوه ارسال</th>
                            <th>وضعیت سفارش</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>523523</td>
                                <td>25.000 تومان</td>
                                <td>5.000 تومان</td>
                                <td>20.000</td>
                                <td>پرداخت شده</td>
                                <td>آنلاین</td>
                                <td>ملت</td>
                                <td>در حال ارسال</td>
                                <td>پیک موتوری</td>
                                <td>در حال ارسال</td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-images"></i> مشاهده فاکتور</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-window-close"></i> باطل کردن سفارش</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td>523523</td>
                                <td>25.000 تومان</td>
                                <td>5.000 تومان</td>
                                <td>20.000</td>
                                <td>پرداخت شده</td>
                                <td>آنلاین</td>
                                <td>ملت</td>
                                <td>در حال ارسال</td>
                                <td>پیک موتوری</td>
                                <td>در حال ارسال</td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-images"></i> مشاهده فاکتور</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-window-close"></i> باطل کردن سفارش</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <td>523523</td>
                                <td>25.000 تومان</td>
                                <td>5.000 تومان</td>
                                <td>20.000</td>
                                <td>پرداخت شده</td>
                                <td>آنلاین</td>
                                <td>ملت</td>
                                <td>در حال ارسال</td>
                                <td>پیک موتوری</td>
                                <td>در حال ارسال</td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-images"></i> مشاهده فاکتور</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-list-ul"></i> تغییر وضعیت ارسال</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-edit"></i> تغییر وضعیت سفارش</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-window-close"></i> باطل کردن سفارش</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
