@extends('admin.layouts.master')


@section('head-tag')
<title>پست ها</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.content.category.index') }}">بخش کحتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            پست ها
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        پست ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.create') }}" class="btn btn-info btn-sm">ایجاد پست جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>دسته</th>
                            <th>تصویر</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>چگونه از باطری موبایل خود نگهداری کنیم؟</td>
                                <td>اقتصادی</td>
                                <td><img src="{{ asset('admin-assets/images/samsung-s23.jpg') }}" alt="Product-Image" style="max-height: 4rem; mix-blend-mode: multiply;"></td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i>  حذف</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
