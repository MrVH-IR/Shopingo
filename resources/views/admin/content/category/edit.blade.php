@extends('admin.layouts.master')


@section('head-tag')
    <title>تغییر دسته بندی</title>
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 999;
            inset: 0;
            background-color: rgba(0,0,0,0.85);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            max-width: 90vw;
            max-height: 90vh;
            width: auto;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0,0,0,0.6);
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 40px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            transition: color 0.3s;
            z-index: 1000;
        }
        .close-btn:hover {
            color: #ff4d4d;
        }

        .fade-in {
            animation: modalFadeIn 0.3s ease forwards;
        }
        .zoom-in {
            animation: zoomIn 0.3s ease forwards;
        }

        .fade-out {
            animation: modalFadeOut 0.3s ease forwards;
        }
        .zoom-out {
            animation: zoomOut 0.3s ease forwards;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes modalFadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        @keyframes zoomOut {
            from { transform: scale(1); opacity: 1; }
            to { transform: scale(0.8); opacity: 0; }
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
                <a href="{{ route('admin.market.category.index') }}">بخش فروش</a>
            </li>
            <li class="breadcrumb-item font-size-12">
                <a href="{{ route('admin.market.category.index') }}">دسته بندی</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                تعییر دسته بندی
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
                    <form action="{{ route('admin.content.category.update', $postCategory->id) }}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method("put")
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category" class="h6">نام دسته</label>
                                    <input type="text" name="name" id="Category" class="form-control form-control-sm" value="{{ old('name' , $postCategory->name) }}">
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
                                    <input type="hidden" name="tags" id="tags" class="form-control form-control-sm d-none" value="{{ old('tags', $postCategory->tags) }}">
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
                                        <option value="0" @if(old('status' , $postCategory->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $postCategory->status) == 1) selected @endif>فعال</option>
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

                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach($postCategory->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6/ $number }}">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input d-flex align-items-center" name="currentImage"
                                                       value="{{ $key }}" id="{{ $number }}" @if($postCategory->image['currentImage'] == $key)
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
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description" class="h6">توضیحات</label>
                                    <textarea class="form-control form-control-sm ckeditor" rows="6" name="description" id="description">
                                        {{ old('description', $postCategory->description) }}
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const closeBtn = document.querySelector('.close-btn');

            document.querySelectorAll('.preview-img').forEach(img => {
                img.addEventListener('click', function() {
                    modal.style.display = "flex";
                    modal.classList.remove('fade-out');
                    modalImg.classList.remove('zoom-out');
                    modal.classList.add('fade-in');
                    modalImg.classList.add('zoom-in');
                    modalImg.src = this.src;
                });
            });

            function closeModal() {
                modal.classList.remove('fade-in');
                modalImg.classList.remove('zoom-in');
                modal.classList.add('fade-out');
                modalImg.classList.add('zoom-out');
                setTimeout(() => {
                    modal.style.display = "none";
                }, 300);
            }

            closeBtn.addEventListener('click', closeModal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
