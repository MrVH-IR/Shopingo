@extends('admin.layouts.master')


@section('head-tag')
<title>نقش ها</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="#">بخش کاربران</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            نقش ها
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نقش ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm">ایجاد نقش چدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نام نقش</th>
                            <th>دسترسی ها</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>پشتیبان فروش</td>
                                <th>
                                    <ul>
                                        <li>مشاهده سفارش ها</li>
                                        <li>مشاهده پرداخت ها</li>
                                        <li>مشاهده تخفیف ها</li>
                                    </ul>
                                </th>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>   دسترسی ها</a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i>  حذف</button>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>مدیر محتوا</td>
                                <th><ul>
                                    <li>مشاهده پست ها</li>
                                    <li>مشاهده پیج ها</li>
                                    <li>مشاهده نظرات ها</li>
                                </ul>
                                </th>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>   دسترسی ها</a>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>  ویرایش</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i>  حذف</button>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>اپراتور تیکت ها</td>
                                <th>
                                    <ul>
                                        <li>مشاهده تیکت ها</li>
                                        <li>بستن تیکت ها</li>
                                        <li>پاسخ تیکت ها</li>
                                    </ul>
                                </th>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>   دسترسی ها</a>
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
