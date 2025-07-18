@extends('admin.layouts.master')

@section('head-tag')
<title>نظرات</title>
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
            نظرات
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm" tabindex="-1" aria-disabled="true" style="cursor: not-allowed; pointer-events: none; opacity: 0.65;">ایجاد نظر جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" name="search" id="search" class="form-control form-control-sm form-text">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>نویسنده نظر</th>
                            <th>کد کاربر</th>
                            <th>کد کالا</th>
                            <th>کالا</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>سحیل کاشانی</td>
                                <td>4567542</td>
                                <td>3896321</td>
                                <td>شیائومی Note 20</td>
                                <td>تایید شده</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.comment.show') }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  نمایش</a>
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-clock"></i>  عدم تایید</button>
                                </td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>امین موصدوفی</td>
                                <td>4563421</td>
                                <td>3895212</td>
                                <td>شارژر type C</td>
                                <td>در انتظار تایید</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.comment.show') }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  نمایش</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i>  تایید</button>
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>پژمان وطن خواه</td>
                                <td>4354122</td>
                                <td>3876541</td>
                                <td>ساعت هوشمند apple watch</td>
                                <td>در انتظار تایید</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.comment.show') }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>  نمایش</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i>  تایید</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>

@endsection
