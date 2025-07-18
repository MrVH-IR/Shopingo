@extends('admin.layouts.master')


@section('head-tag')
<title>اضافه کردن به انبار</title>
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
            <a href="{{ route('admin.market.store.index') }}">انبار</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            اضافه کردن موجودی به انبار
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
            اضافه کردن موجودی به انبار
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام تحویل گیرنده</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام دهنده</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">تعداد</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="Category" class="h6">توضیحات</label>
                                    <textarea name="" id="" role="4" class="form-control form-control-sm"></textarea>
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
