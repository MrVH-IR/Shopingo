@extends('admin.layouts.master')


@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>تنظیمات سایت</title>
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
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                تنظیمات
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                ویرایش تنظیمات
            </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش تنظیمات
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.setting.update' , $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title" class="h6">عنوان سایت</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-sm" value="{{ old('title' , $setting->title) }}">
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
                                    <label for="description" class="h6">توضیحات سایت</label>
                                    <input type="text" name="description" id="description" class="form-control form-control-sm" value="{{ old('title' , $setting->description) }}">
                                </div>
                                @error('description')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="keywords" class="h6">کلمات کلیدی سایت</label>
                                    <input type="text" name="keywords" id="keywords" class="form-control form-control-sm" value="{{ old('title' , $setting->keywords) }}">
                                </div>
                                @error('keywords')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mt-4">
                                <div class="form-group">
                                    <input type="file" id="logo" name="logo" class="custom-file-input">
                                    <label for="logo" class="custom-file-label">📎 انتخاب فایل</label>
                                    <span id="file-chosen" style="margin-right:10px;">هیچ فایلی انتخاب نشده</span>
                                </div>
                                @error('logo')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mt-4">
                                <div class="form-group">
                                    <input type="file" id="favicon" name="favicon" class="custom-file-input">
                                    <label for="favicon" class="custom-file-label">📎 انتخاب فایل</label>
                                    <span id="file-chosen" style="margin-right:10px;">هیچ فایلی انتخاب نشده</span>
                                </div>
                                @error('icon')
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
    <script>
        document.getElementById("logo").addEventListener("change", function(){
            document.getElementById("file-chosen").textContent = this.files[0]?.name || "هیچ فایلی انتخاب نشده";
        });

        document.getElementById("favicon").addEventListener("change", function(){
            document.getElementById("file-chosen-favicon").textContent = this.files[0]?.name || "هیچ فایلی انتخاب نشده";
        });
    </script>
@endsection

