@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد کالا </title>
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
            <a href="{{ route('admin.market.product.index') }}">کالا ها</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ایجاد کالا
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد کالا
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام کالا</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">دسته کالا</label>
                                        <select name="" id="" class="form-control form-control-sm">
                                            <option value="">دسته را انتخاب کنید</option>
                                            <option value="Electronics">وسایل الکترونیک</option>
                                        </select>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">فرم کالا</label>
                                        <select name="" id="" class="form-control form-control-sm">
                                            <option value="">دسته را انتخاب کنید</option>
                                            <option value="Electronics">وسایل الکترونیک</option>
                                        </select>
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="">تصویر</label>
                                <input type="file" class="form-control form-controm-sm">
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">قیمت کالا</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="" class="h6">وزن</label>
                                <input type="text" class="form-control form-controm-sm" style="max-height: 2rem">
                            </section>
                            <section class="col-12">
                                <label for="">توضیجات</label>
                                <textarea name="formbody" id="formbody" class="form-control form-control-sm" rows="10" cols="80"></textarea>
                            </section>
                            <section class="col-12 border-top border-bottom py-3 mb-3">
                                <div class="row">
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm" placeholder="ویژگی...">
                                        </div>
                                    </section>
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm" placeholder="مقدار...">
                                        </div>
                                    </section>
                                </div>
                                <div class="col-6 my-3">
                                    <button type="button" class="btn btn-success btn-sm">افزودن</button>
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
<script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'formbody' );
</script>
@endsection
