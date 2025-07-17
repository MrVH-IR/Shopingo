@extends('admin.layouts.master')


@section('head-tag')
<title>پرداخت ها</title>
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
            پرداخت ها
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        پرداخت ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">پرداخت جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>کد تراکنش</th>
                            <th>بانک</th>
                            <th>پرداخت کننده</th>
                            <th>وضعیت پرداخت</th>
                            <th>نوع پرداخت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>4534534</td>
                                <td>ملت</td>
                                <td>محمد رضا</td>
                                <td>تایید شده</td>
                                <td>آنلاین</td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>  مشاهده</a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-close"></i>  باطل کردن</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  برگرداندن</a>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>6126126</td>
                                <td>ملی</td>
                                <td>کمال رضا</td>
                                <td>تایید شده</td>
                                <td>آنلاین</td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>  مشاهده</a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-close"></i>  باطل کردن</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  برگرداندن</a>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>1261261</td>
                                <td>آینده</td>
                                <td>علی رضا</td>
                                <td>تایید شده</td>
                                <td>افلاین</td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>  مشاهده</a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-close"></i>  باطل کردن</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>  برگرداندن</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
