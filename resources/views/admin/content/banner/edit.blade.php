@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش بنر</title>
<style>
    .custom-file-upload {
        position: relative;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .file-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
        border: 2px solid transparent;
    }

    .file-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .file-label:active {
        transform: translateY(0);
    }

    .file-name {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.9);
        margin-right: 10px;
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
             <a href="{{ route('admin.market.category.index') }}">بخش محتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.content.banner.index') }}">بنر ها</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش بنر
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        بنر
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.banner.update' , $banner->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title" class="h6">عنوان بنر</label>
                                        <input type="text" name="title" id="title" class="form-control form-control-sm" value="{{ old('title' , $banner->title) }}">
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
                                    <label for="link">آدرس URL</label>
                                    <input type="text" name="link" id="link" class="form-control form-control-sm" value="{{ old('link' , $banner->link) }}">
                                </div>
                                @error('link')
                                    <div class="alert alert-danger">
                                        <li>
                                            {{ $message }}
                                        </li>
                                    </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="position">موقعیت</label>
                                    <select id="position" name="position" class="form-control form-control-sm">
                                        <option value="0" @if(old('position' , $banner->position) == 0) selected @endif>اسلاید شو (صفحه اصلی)</option>
                                        <option value="1" @if(old('position' , $banner->position) == 1) selected @endif>کنار اسلاید شو (صفحه اصلی)</option>
                                        <option value="2" @if(old('position' , $banner->position) == 2) selected @endif>دو بنر تبلیغی بین دو اسلاید (صفحه اصلی)</option>
                                        <option value="3" @if(old('position' , $banner->position) == 3) selected @endif>بنر تبلیغی بزرگ پایین دو اسلایدر (صفحه اصلی)</option>
                                    </select>
                                </div>
                                @error('position')
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
                                            <option value="0" @if(old('status' , $banner->status) == 0) selected @endif>غیر قعال</option>
                                            <option value="1" @if(old('status' , $banner->status) == 1) selected @endif>فعال</option>
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
                                    <div class="custom-file-upload">
                                        <input type="file" name="image" id="image" class="file-input"
                                               accept="image/png, image/jpg, image/jpeg, image/webp, image/svg, image/gif">
                                        <label for="image" class="file-label">
                                            <i class="fas fa-cloud-upload-alt ml-2"></i>
                                            <span class="file-label-text">انتخاب تصویر</span>
                                            <span class="file-name text-muted mr-2"></span>
                                        </label>
                                    </div>
                                    <img src="#" id="preview" class="d-none mw-200 mt-10" style="max-width: 200px;">
                                    <div id="imageError" class="text-danger small mt-1" style="display:none;"></div>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>

                            <section class="row">
                                    <section class="col-md-5">
                                        <div class="form-check">
                                            <label for="" class="form-check-label mx-2">
                                                <img src="{{ asset($banner->image) }}" class="w-100 preview-img mt-4">
                                            </label>
                                        </div>
                                    </section>
                            </section>

                            <section class="col-12 mt-2">
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
    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        const errorDiv = document.getElementById('imageError');

        imageInput.onchange = function(evt) {
            if (errorDiv) errorDiv.style.display = 'none';

            if (preview.src && preview.src !== '#') {
                URL.revokeObjectURL(preview.src);
            }

            const file = this.files[0];

            if (!file) {
                preview.classList.add('d-none');
                preview.src = '#';
                return;
            }

            const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp', 'image/svg+xml', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                if (errorDiv) {
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = 'فرمت فایل نامعتبر است. فقط PNG, JPG, JPEG, WEBP, SVG, GIF مجاز هستند.';
                }
                preview.classList.add('d-none');
                preview.src = '#';
                this.value = '';
                return;
            }
            preview.classList.remove('d-none');
            preview.src = URL.createObjectURL(file);
        };
    </script>
@endsection
