@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>ایجاد اطلاعیه ایمیلی</title>
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
            <a href="{{ route('admin.email.index') }}">اطلاعیه ایمیلی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش اطلاعیه ایمیلی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش اطلاعیه ایمیلی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.email.update' , $email->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="h6">عنوان ایمیل</label>
                                        <input type="text" name="subject" id="subject" class="form-control form-control-sm" value="{{ old('subject' , $email->subject) }}">
                                </div>
                                @error('subject')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="publish_date" class="h6">تاریخ انتشار</label>
                                    <input type="text" id="publish_date" name="published_at" class="form-control form-control-sm jalali-input" data-jdp data-jdp-format="YYYY-MM-DD"
                                     value="{{ old('published_at' , $email->published_at_jalali) }}">
                                    <i class="fa fa-calendar position-absolute" id="calendar_icon"
                                       style="top: 60%; left: 20px; transform: translateY(-50%); cursor: pointer;"></i>
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
                                        <option value="0" @if(old('status' , $email->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $email->status) == 1) selected @endif>فعال</option>
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
                            @if ($email->file)
                                <p>فایل پیوست: {{ $email->file->file_path }}</p>
                                <a href="{{ route('admin.email.file.download' , $email->file->id) }}" target="_blank" class="btn btn-primary">
                                    مشاهده / دانلود
                                </a>
                            @endif

                            <section class="col-12">
                                <label for="faq">متن ایمیل</label>
                                <textarea name="body" id="body" class="form-control form-control-sm ckeditor" rows="10">
                                    {{ old('body' , $email->body) }}
                                </textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
@endsection
