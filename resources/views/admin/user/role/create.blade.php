@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد نقش</title>
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
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.user.role.index') }}">نقش ها</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
           ایجاد نقش
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
         ایجاد نقش
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="Category" class="h6">عنوان نقش</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="Category" class="h6">توضیح نقش</label>
                                        <input type="text" name="" id="" class="form-control form-control-sm">
                                </div>
                            </section>
                            <section class="col-12 col-md-2 mt-md-4">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                            <section class="col-12">
                                <section class="row border-top mt-3 py-3">
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check1" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check1">نمایش دسته جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check2" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check2">ایجاد دسته جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check2" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check2">ویرایش دسته جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check3" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check3">حذف کالای جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check4" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check4">حذف دسته جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check5" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check5">نمایش کالای جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check6" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check6">ایجاد کالای جدید</label>
                                        </div>
                                    </section>
                                    <section class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="" id="check7" checked>
                                            <label class="form-check-label mr-3 mt-1" for="check7">ویرایش کالای جدید</label>
                                        </div>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
