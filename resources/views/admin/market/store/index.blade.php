@extends('admin.layouts.master')


@section('head-tag')
<title>انبار</title>
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
            انبار
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        انبار
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">ایجاد انبار جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <td>نام کالا</td>
                            <td>تصویر کلا</td>
                            <td>موجودی</td>
                            <td>ورودی انبار</td>
                            <td>خروجی انبار</td>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <th>تلویزیو اسمارت LG</th>
                                <th><img src="{{ asset('admin-assets/images/LG-TV.jpeg') }}" style="max-height: 3rem; mix-blend-mode: multiply;" alt="Product-Image"></th>
                                <th>10 تا</th>
                                <th>20 تا</th>
                                <th>10 تا</th>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.store.addToStore') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i>  اصلاح موجودی</button>
                                </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>IPhone 12 S</th>
                                <th><img src="{{ asset('admin-assets/images/Iphone-12.png') }}" style="max-height: 3rem; mix-blend-mode: multiply;" alt="Product-Image"></th>
                                <th>5 تا</th>
                                <th>15 تا</th>
                                <th>10 تا</th>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.store.addToStore') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i>  اصلاح موجودی</button>
                                </td>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>Samsung S23</th>
                                <th><img src="{{ asset('admin-assets/images/samsung-s23.jpg') }}" style="max-height: 3rem; mix-blend-mode: multiply;" alt="Product-Image"></th>
                                <th>20 تا</th>
                                <th>30 تا</th>
                                <th>10 تا</th>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.market.store.addToStore') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i>  اصلاح موجودی</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
