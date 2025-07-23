@extends('admin.layouts.master')

@section('head-tag')
<title>اطلاعیه پیامکی</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.email.index') }}"> اطلاع رسانی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            اطلاعیه پیامکی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        اطلاعیه پیامکی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.sms.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه پیامکی جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>عنوان اطلاعیه</th>
                            <th>تاریخ ارسال</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>فروش ویژه بهاری</td>
                                <td>1402/01/01</td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  ویرایش</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-clock"></i>   حذف</button>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>فروش ویژه تابستانه</td>
                                <td>1402/04/01</td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  ویرایش</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-clock"></i>   حذف</button>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>فروش ویژه زمستانه</td>
                                <td>1402/07/01</td>
                                <td class="width-16-rem text-left">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  ویرایش</a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-clock"></i>   حذف</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
