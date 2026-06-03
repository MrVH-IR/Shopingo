@extends('admin.layouts.master')


@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>ایجاد رنگ کالا </title>
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
            ایجاد رنگ کالا
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد رنگ کالا
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.color.index' , $product->id) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.color.store' , $product->id) }}" method="POST">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="color_name" class="h6">نام رنگ</label>
                                        <input type="text" name="color_name" value="{{ old('color_name') }}" class="form-control form-control-sm">
                                </div>
                                @error('color_name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="color" class="h6">رنگ</label>
                                    <input type="color" name="color" value="{{ old('color' , '#000000') }}" class="form-control form-control-sm form-control-color">
                                </div>
                                @error('color')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="price_increase" class="h6">افزایش قیمت کالا</label>
                                        <input type="text" name="price_increase" value="{{ old('price_increase') }}" class="form-control form-control-sm">
                                </div>
                                @error('price_increase')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
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
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
    <script>
        $(function () {
            $('#btn-copy').on('click' , function () {
                var ele = $(this).parent().prev().clone(true);
                $(this).before(ele);
            })
        })
    </script>
@endsection
