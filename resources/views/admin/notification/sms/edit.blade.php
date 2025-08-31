@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>ایجاد اطلاعیه پیامکی</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="#">اطلاع رسانی</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.email.index') }}">اطلاعیه پیامکی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش اطلاعیه پیامکی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش اطلاعیه پیامکی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.sms.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.sms.update' , $sms->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title" class="h6">عنوان پیامک</label>
                                        <input type="text" name="title" id="title" class="form-control form-control-sm" value="{{ old('title' , $sms->title) }}">
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
                                <div class="form-group datepicker-wrapper">
                                    <label for="published_at" class="h6">تاریخ انتشار</label>
                                    <input type="text" id="published_at" name="published_at" class="form-control form-control-sm jalali-input" value="{{ old('published_at' , $sms->published_at_jalali) }}">
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
                                    <label for="Status-Select" class="h6">وضعیت</label>
                                    <select name="status" id="Status-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status' , $sms->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $sms->status) == 1) selected @endif>فعال</option>
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
                            <section class="col-12">
                                <label for="faq">متن پیامک</label>
                                <textarea name="body" id="body" class="form-control form-control-sm ckeditor" rows="10">{{ old('body' , $sms->body) }}</textarea>
                                @error('body')
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
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
@endsection

