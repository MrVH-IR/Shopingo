@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد کوپن تخفیف</title>
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
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.market.discount.copan') }}">کوپن تخفیف</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ایجاد کوپن تخفیف
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                       ایجاد کوپن تخفیف
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">کد کوپن</label>
                                        <input type="text" name="discount" id="" class="form-control form-control-sm">
                                        <i class="fa fa-bolt" onclick="randomDiscount()"> ایجاد کد رندوم</i>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="Category" class="h6">نوع کوپن</label>
                                    <select name="" id="" class="form-control form-control-sm">
                                        <option value="">عمومی</option>
                                        <option value="">خصوصی</option>
                                    </select>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">درصد تخفیف</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">حداکثر تخفیف</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">عنوان مناسبت</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="start_date" class="h6 d-flex">تاریخ شروع</label>
                                    <input type="text" id="start_date" name="start_date" class="form-control form-control-sm flatpickr-date" placeholder="انتخاب تاریخ شروع">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="h6 d-flex">تاریخ پایان</label>
                                    <input type="text" id="end_date" name="end_date" class="form-control form-control-sm flatpickr-date" placeholder="انتخاب تاریخ پایان">
                                </div>
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection

@section('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fa.js"></script>
<script>
    flatpickr(".flatpickr-date", {
        "locale": "fa",
        dateFormat: "Y-m-d",
        disableMobile: true,
        altInput: true,
        altFormat: "F j, Y",
    });

    function randomDiscount(length = 10)
    {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0 ; i < length ; i++){
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        document.getElementsByName('discount')[0].value = result;
    }
</script>
@endsection
