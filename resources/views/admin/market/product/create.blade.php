@extends('admin.layouts.master')


@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
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
                    <form action="{{ route('admin.market.product.store') }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name" class="h6">نام کالا</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm">
                                </div>
                                @error('name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product_categories" class="h6">انتخاب دسته (فقط فعال ها)</label>
                                    <select name="product_categories" id="product_categories" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($productCategories as $id => $name)
                                            <option value="{{ $id }}" @if( old('product_categories') == $id) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_categories')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select-Brand" class="h6">انتخاب برند (فقط فعال ها)</label>
                                    <select name="brand_id" id="Category-Select-Brand" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" @if( old('brand_id') == $brand->id) selected @endif>{{ $brand->original_name }} - {{ $brand->persian_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('brand_id')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="image">تصویر</label>
                                <input type="file" name="image" class="form-control form-controm-sm">
                                @error('image')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="price" class="h6">قیمت کالا</label>
                                        <input type="text" name="price" value="{{ old('price') }}" class="form-control form-control-sm">
                                </div>
                                @error('price')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="weight" class="h6">وزن</label>
                                <input type="text" name="weight" value="{{ old('weight') }}" class="form-control form-controm-sm" style="max-height: 2rem">
                                @error('weight')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="length" class="h6">طول</label>
                                <input type="text" name="length" value="{{ old('length') }}" class="form-control form-controm-sm" style="max-height: 2rem">
                                @error('length')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="width" class="h6">عرض</label>
                                <input type="text" name="width" value="{{ old('width') }}" class="form-control form-controm-sm" style="max-height: 2rem">
                                @error('width')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <label for="height" class="h6">ارتفاع</label>
                                <input type="text" name="height" value="{{ old('height') }}" class="form-control form-controm-sm" style="max-height: 2rem">
                                @error('height')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status" class="h6">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status') == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="marketable" class="h6">قابل فروش بودن</label>
                                    <select name="marketable" id="marketable" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('marketable') == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('marketable') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('marketable')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group datepicker-wrapper">
                                    <label for="published_at" class="h6">تاریخ انتشار</label>
                                    <input type="text" id="published_at" name="published_at" class="form-control form-control-sm jalali-input" value="{{ old('published_at') }}">
                                    <i class="fa fa-calendar position-absolute"
                                       style="top: 60%; left: 20px; transform: translateY(-50%); cursor: pointer;"
                                       id="calendar_icon"></i>
                                </div>
                                @error('published_at')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="tags" class="h6">نام تگ ها</label>
                                    <input type="hidden" name="tags" id="tags" class="form-control form-control-sm d-none" value="{{ old('tags') }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <label for="description">توضیجات</label>
                                <textarea name="description" id="formbody" class="form-control form-control-sm ckeditor" rows="10" cols="80">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 border-top border-bottom py-3 mb-3">
                                <div class="row">
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="meta_key[]" class="form-control form-control-sm" placeholder="ویژگی...">
                                        </div>
                                        @error('meta_key')
                                        <div class="alert alert-danger">
                                            <li>
                                                {{ $message }}
                                            </li>
                                        </div>
                                        @enderror
                                    </section>
                                    <section class="col-6 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="meta_value[]" class="form-control form-control-sm" placeholder="مقدار...">
                                        </div>
                                        @error('meta_value')
                                        <div class="alert alert-danger">
                                            <li>
                                                {{ $message }}
                                            </li>
                                        </div>
                                        @enderror
                                    </section>
                                </div>
                                <div class="col-6 my-3">
                                    <button type="button" class="btn btn-success btn-sm" id="btn-copy">افزودن</button>
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
