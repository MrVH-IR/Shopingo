@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش دسته بندی</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">
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
            <a href="{{ route('admin.market.category.index') }}">دسته بندی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش دسته بندی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسته بندی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.category.update' , $productCategory->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @method("PUT")
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name" class="h6">نام دسته</label>
                                        <input type="text" name="name" value="{{ old('name' , $productCategory->name) }}" class="form-control form-control-sm">
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
                                    <label for="parent_id" class="h6">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="">منو اصلی</option>
                                        @foreach($parent_categories as $parent_category)
                                            <option value="{{ $parent_category->id }}" @if(old('parent_id' , $productCategory->parent_id) == $parent_category->id) selected @endif>
                                                {{ $parent_category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
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
                                        <option value="0" @if(old('status' , $productCategory->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $productCategory->status) == 1) selected @endif>فعال</option>
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
                                    <label for="show_in_menu" class="h6">نمایش در منو</label>
                                    <select name="show_in_menu" id="show_in_menu" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('show_in_menu' , $productCategory->show_in_menu) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('show_in_menu' , $productCategory->show_in_menu) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('show_in_menu')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="tags" class="h6">نام تگ ها</label>
                                    <input type="hidden" name="tags" id="tags" class="form-control form-control-sm d-none" value="{{ old('tags' , $productCategory->tags) }}">
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
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image" class="h6">تصویر</label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm" accept="image/png , image/jpg ,
                                    image/jpeg , image/webp , image/svg">
                                </div>
                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach($productCategory->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6/ $number }}">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input d-flex align-items-center" name="currentImage"
                                                       value="{{ $key }}" id="{{ $number }}" @if($productCategory->image['currentImage'] == $key)
                                                           checked
                                                    @endif>
                                                <label for="{{ $number }}" class="form-check-label mx-2">
                                                    <img src="{{ asset($value) }}" class="w-100 preview-img mt-4">
                                                </label>
                                            </div>
                                        </section>
                                        @php
                                            $number ++;
                                        @endphp
                                    @endforeach
                                </section>
                                @error('image')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description" class="h6">توضیحات</label>
                                    <textarea class="form-control form-control-sm ckeditor" rows="6" name="description" id="description">
                                        {{ old('description' , $productCategory->description) }}
                                    </textarea>
                                </div>
                                @error('description')
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

<div id="imageModal" class="modal-overlay">
    <span class="close-btn">&times;</span>
    <img class="modal-content" id="modalImage">
</div>


@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
