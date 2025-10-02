@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد دسته بندی</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
             <a href="{{ route('admin.market.category.index') }}">بخش محتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.market.category.index') }}">دسته بندی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ایجاد دسته بندی
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
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.category.store') }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام دسته</label>
                                        <input type="text" name="name" id="Category" class="form-control form-control-sm" value="{{ old('name') }}">
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
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">وضعیت</label>
                                        <select name="status" id="Category-Select" class="form-control form-control-sm">
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
                                    <label for="image" class="h6">تصویر</label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm" accept="image/png , image/jpg ,
                                    image/jpeg , image/webp , image/svg">
                                </div>
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
                                        {{ old('description') }}
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
                                @if(session('success'))
                                    <div class="ring-offset-emerald-400">
                                        <span>{{ $message }}</span>
                                    </div>
                                @endif
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
@endsection
