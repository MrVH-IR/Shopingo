@extends('admin.layouts.master')


@section('head-tag')
<title>ویرایش ایجاد مقدار فرم کالا</title>
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
            ویرایش ایجاد مقدار فرم کالا
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
            ویرایش ایجاد  مقدار فرم کالا
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.value.index' , $categoryAttribute->id) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.value.update' , ["categoryAttribute" => $categoryAttribute->id , "value" => $value->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product_id" class="h6">انتخاب محصول</label>
                                    <select name="product_id" id="product_id" class="form-control form-control-sm">
                                        <option value="">محصول را انتخاب کنید</option>
                                        @foreach($categoryAttribute->category->products as $product)
                                            <option value="{{ $product->id }}" @if( old('product_id' , $value->product_id) == $product->id ) selected @endif>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-warning">نوع نمایش ویژگی را انتخاب کنید (مثلاً: select یا text)</small>
                                </div>

                                @error('product_id')
                                <div class="alert alert-danger">
                                    <li>{{ $message }}</li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="value" class="h6">مقدار</label>
                                        <input type="text" name="value" value="{{ old('value' , json_decode($value->value)->value) }}" class="form-control form-control-sm">
                                </div>
                                @error('value')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="price_increase" class="h6">افزایش قیمت</label>
                                    <input type="text" name="price_increase" value="{{ old('price_increase' , json_decode($value->value)->price_increase) }}" class="form-control form-control-sm">
                                </div>
                                @error('price_increase')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <div class="form-group col-md-6">
                                <label for="type" class="h6">نوع</label>
                                <select name="type" id="type" class="form-control form-control-sm">
                                    <option value="">انتخاب کنید</option>
                                    <option value="0" {{ old('type' , $value->type) == '0' ? 'selected' : '' }}>ساده</option>
                                    <option value="1" {{ old('type' , $value->type) == '1' ? 'selected' : '' }}>انتخابی</option>
                                </select>
                                <small class="form-text text-warning">نوع نمایش ویژگی را انتخاب کنید (مثلاً: select یا text)</small>
                                @error('type')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </div>
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
