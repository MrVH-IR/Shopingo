@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>ایجاد اطلاعیه ایمیلی</title>
<style>
    .custom-file-input {
        display: none;
    }
    .custom-file-label {
        display: inline-block;
        padding: 8px 16px;
        border: 2px dashed #6c757d;
        border-radius: 8px;
        cursor: pointer;
        background-color: #f8f9fa;
        transition: 0.3s;
    }
    .custom-file-label:hover {
        background-color: #e9ecef;
    }
</style>
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
            ایجاد اطلاعیه ایمیلی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                         ایجاد اطلاعیه ایمیلی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.email.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="h6">عنوان ایمیل</label>
                                        <input type="text" name="subject" id="subject" class="form-control form-control-sm" value="{{ old('subject') }}">
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
                                     value="{{ old('published_at') }}">
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
                            <section class="col-12 col-md-6 mt-4">
                                <div class="form-group">
                                    <input type="file" id="file" name="file" class="custom-file-input">
                                    <label for="file" class="custom-file-label">📎 انتخاب فایل</label>
                                    <span id="file-chosen" style="margin-right:10px;">هیچ فایلی انتخاب نشده</span>
                                </div>
                                @error('file')
                                    <div class="alert alert-danger">
                                        <li>
                                            {{ $message }}
                                        </li>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <label for="faq">متن ایمیل</label>
                                <textarea name="body" id="body" class="form-control form-control-sm ckeditor" rows="10">
                                    {{ old('body') }}
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
    <script>
        document.getElementById("file").addEventListener("change", function(){
            document.getElementById("file-chosen").textContent = this.files[0]?.name || "هیچ فایلی انتخاب نشده";
        });
    </script>
@endsection
