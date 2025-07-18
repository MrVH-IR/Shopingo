@extends('admin.layouts.master')


@section('head-tag')
<title>کالا ها</title>
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
           کالا ها
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                         کالا ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">ایجاد کالای جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>تصویر کالا</th>
                            <th>قیمت کالا</th>
                            <th>وزن کالا</th>
                            <th>دسته</th>
                            <th>فرم کالا</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>گوشی آیفون 12</td>
                                <td><img src="{{ asset('admin-assets/images/Iphone-12.png') }}" alt="Product" style="max-height: 4rem; mix-blend-mode: multiply;"></td>
                                <td>12.000.000 تومان</td>
                                <td>1 کیلو</td>
                                <td>کالای الکترونیکی</td>
                                <td>اندازه نمایشگر</td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-images"></i>گالری</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-list-ul"></i>فرم کالا</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-edit"></i>ویرایش</a>
                                            <form action="POST">
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-right"><i class="fa fa-window-close"></i> حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>تلویزیون Smart TV LG</td>
                                <td><img src="{{ asset('admin-assets/images/LG-TV.jpeg') }}" alt="Product" style="max-height: 4rem; mix-blend-mode: multiply;"></td>
                                <td>90.000.000 تومان</td>
                                <td>12 کیلو</td>
                                <td>کالای الکترونیکی</td>
                                <td>اندازه نمایشگر</td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-images"></i>گالری</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-list-ul"></i>فرم کالا</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-edit"></i>ویرایش</a>
                                            <form action="POST">
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-right"><i class="fa fa-window-close"></i> حذف</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>گوشی سامسونگ S23</td>
                                <td><img src="{{ asset('admin-assets/images/samsung-s23.jpg') }}" alt="Product" style="max-height: 4rem; mix-blend-mode: multiply;"></td>
                                <td>60.000.000 تومان</td>
                                <td>250 گرم</td>
                                <td>کالای الکترونیکی</td>
                                <td>اندازه نمایشگر</td>
                                <td class="width-8-rem text-left">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-tools"></i>عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-images"></i>گالری</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-list-ul"></i>فرم کالا</a>
                                            <a class="dropdown-item text-right" href="#"><i class="fa fa-edit"></i>ویرایش</a>
                                            <form action="POST">
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-right"><i class="fa fa-window-close"></i> حذف</button>
                                            </form>
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
