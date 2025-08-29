@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد منو</title>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.home') }}">خانه</a>
        </li>
        <li class="breadcrumb-item font-size-12">
            <a href="{{ route('admin.content.page.index') }}">بخش محتوا</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            منو
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش منو
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش منو
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.menu.update' , $menu->id) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name" class="h6">عنوان منو</label>
                                        <input type="text" placeholder="مثلا : تماس با ما" name="name" id="name" class="form-control form-control-sm" value="{{ old('name' , $menu->name) }}">
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
                                    <label for="Category-Select" class="h6">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="">منو اصلی</option>
                                        @foreach($parent_menus as $parent_menu)
                                            <option value="{{ $parent_menu->id }}" @if(old('parent_id' , $parent_menu->parent_id) == $parent_menu->id) selected @endif >{{ $parent_menu->name }}</option>
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
                                    <label for="url" class="h6">آدرس URL</label>
                                    <input
                                        type="text"
                                        name="url"
                                        id="url"
                                        class="form-control form-control-sm"
                                        value="{{ old('url', $menu->url) }}"
                                        placeholder="مثلاً: contact-us"
                                    >
                                    <small class="text-muted mt-1 d-block">
                                        آدرس معتبر:
                                        <code class="bg-light px-1 py-1 rounded border mx-1">contact-us</code>
                                        <code class="bg-light px-1 py-1 rounded border mx-1">about</code>
                                        <code class="bg-light px-1 py-1 rounded border mx-1">hello-world</code>
                                    </small>
                                </div>

                                @error('url')
                                <div class="alert alert-danger mt-2 py-2 small">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="Category-Select" class="h6">وضعیت</label>
                                    <select name="status" id="Category-Select" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status' , $menu->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $menu->status) == 1) selected @endif>فعال</option>
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
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
