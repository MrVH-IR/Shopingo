@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
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
                    <form action="{{ route("admin.content.post.store") }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">عنوان پست</label>
                                        <input type="text" name="title" id="" class="form-control form-control-sm" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">انتخاب دسته (فقط فعال ها)</label>
                                        <select name="category_id" id="Category-Select" class="form-control form-control-sm">
                                            <option value="">دسته را انتخاب کنید</option>
                                            @foreach($postCategories as $id => $name)
                                            <option value="{{ $id }}" @if( old('category_id') == $id) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('category_id')
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
                                        <input type="file" name="image" id="image" class="form-control form-control-sm">
                                </div>
                                @error('image')
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
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Status-Select" class="h6">وضعیت</label>
                                    <select name="status" id="Status-Select" class="form-control form-control-sm">
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
                                    <label for="Commentable-Select" class="h6">امکان درج کامنت</label>
                                    <select name="commentable" id="Commentable-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('commentable') == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('commentable') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('commentable')
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
                                <label for="body">محتوا</label>
                                <textarea class="form-control form-control-sm ckeditor" rows="10" name="body">{{ old('body') }}</textarea>
                            </section>
                            @error('body')
                            <div class="alert alert-danger">
                                <li>
                                    {{ $message }}
                                </li>
                            </div>
                            @enderror
                            <section class="col-12 mt-2">
                                <label for="summary">خلاصه پست</label>
                                <textarea class="form-control form-control-sm ckeditor" rows="10" name="summary">{{ old('summary') }}</textarea>
                            </section>
                            @error('summary')
                            <div class="alert alert-danger">
                                <li>
                                    {{ $message }}
                                </li>
                            </div>
                            @enderror
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
