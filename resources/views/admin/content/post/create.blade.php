@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fa.js"></script>
<title>ایجاد پست</title>
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
            <a href="{{ route('admin.content.post.index') }}"> پست ها</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ایجاد پست
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد پست
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">عنوان پست</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">انتخاب دسته</label>
                                        <select name="" id="" class="form-control form-control-sm">
                                            <option value="">دسته را انتخاب کنید</option>
                                            <option value="Electronics">وسایل الکترونیک</option>
                                        </select>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">تصویر</label>
                                        <input type="file" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">تاریخ انتشار</label>
                                        <input type="date" name="publish_date" id="publish_date" class="form-control form-control-sm flatpickr-date">
                                </div>
                            </section>
                            <section class="col-12">
                                <label for="faq">محتوا</label>
                                <textarea name="body" id="body" class="form-control form-control-sm" rows="10"></textarea>
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
<script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('body');
</script>
<script>
    flatpickr(".flatpickr-date", {
        "locale": "fa",
        dateFormat: "Y-m-d",
        disableMobile: true,
        altInput: true,
        altFormat: "F j, Y",
    });
</script>
@endsection
