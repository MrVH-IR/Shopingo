@extends('admin.layouts.master')


@section('head-tag')
<title>ایجاد فرم کالا</title>
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
            <a href="{{ route('admin.market.property.index') }}">فرم کالا</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ایجاد فرم کالا
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
            ایجاد فرم کالا
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.property.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.property.store') }}" method="POST">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="name" class="h6">نام فرم</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm">
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
                                    <label for="category_id" class="h6">فرم والد</label>
                                        <select name="category_id" class="form-control form-control-sm">
                                            <option value="">فرم را انتخاب کنید</option>
                                            @foreach($productCategories as $productCategory)
                                            <option value="{{ $productCategory->id }}" @if(old('category_id') == $productCategory->id) selected @endif>{{ $productCategory->name }}</option>
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
                                    <label for="unit" class="h6">واحد اندازه گیری</label>
                                    <input type="text" name="unit" value="{{ old('unit') }}" class="form-control form-control-sm">
                                </div>
                                @error('unit')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="type" class="h6">نوع نمایش ویژگی</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="">انتخاب کنید</option>
                                        <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>فیلد متنی (Text)</option>
                                        <option value="select" {{ old('type') == 'select' ? 'selected' : '' }}>لیست انتخابی (Select)</option>
                                        <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>چک‌باکس (Checkbox)</option>
                                        <option value="radio" {{ old('type') == 'radio' ? 'selected' : '' }}>رادیو باتن (Radio)</option>
                                        <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>متن چند خطی (Textarea)</option>
                                    </select>
                                    <small class="form-text text-warning">نوع نمایش ویژگی را انتخاب کنید (مثلاً: select یا text)</small>
                                </div>

                                @error('type')
                                <div class="alert alert-danger">
                                    <li>{{ $message }}</li>
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
