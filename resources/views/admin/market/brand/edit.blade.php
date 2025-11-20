@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد برند</title>
<link rel="stylesheet" href="{{ asset('admin-assets/css/modalStyle.css') }}">

@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.market.brand.index') }}">بخش فروش</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.market.brand.index') }}">برند</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ایجاد برند
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        برند ها
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.brand.update' , $brand->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="persian_name" class="h6">نام فارسی برند</label>
                                        <input type="text" name="persian_name" value="{{ old('persian_name' , $brand->persian_name) }}" class="form-control form-control-sm">
                                </div>
                                @error('persian_name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="original_name" class="h6">نام انگلیسی برند</label>
                                    <input type="text" name="original_name" value="{{ old('original_name' , $brand->original_name) }}" class="form-control form-control-sm">
                                </div>
                                @error('original_name')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">وضعیت</label>
                                    <select name="status" id="Category-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status' , $brand->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $brand->status) == 1) selected @endif>فعال</option>
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
                                    <label for="tags" class="h6">نام تگ ها</label>
                                    <input type="hidden" name="tags" id="tags" class="form-control form-control-sm d-none" value="{{ old('tags' , $brand->tags) }}">
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
                                <div class="form-group">
                                    <label for="image" class="h6">لوگو</label>
                                    <input type="file" class="form-control form-control-sm" name="image" id="">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @if (is_array($brand->image))                 
                                        @foreach($brand->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6/ $number }}">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input d-flex align-items-center" name="currentImage"
                                                value="{{ $key }}" id="{{ $number }}" @if($brand->image['currentImage'] == $key)
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
                                    @endif
                                </section>
                            </section>
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
