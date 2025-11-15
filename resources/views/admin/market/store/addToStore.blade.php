@extends('admin.layouts.master')


@section('head-tag')
<title>اضافه کردن به انبار</title>
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
            <a href="{{ route('admin.market.store.index') }}">انبار</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            اضافه کردن موجودی به انبار
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
            اضافه کردن موجودی به انبار
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.store.store' , $product->id) }}" method="POST">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="receiver" class="h6">نام تحویل گیرنده</label>
                                        <input type="text" name="receiver" id="receiver" class="form-control form-control-sm" value="{{ old('receiver') }}">
                                </div>
                                @error('receiver')
                                <div class="alert alert-danger">
                                    <li>{{ $message }}</li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="deliverer" class="h6">نام تحویل دهنده</label>
                                        <input type="text" name="deliverer" id="deliverer" class="form-control form-control-sm" value="{{ old('deliverer') }}">
                                </div>
                                @error('deliverer')
                                <div class="alert alert-danger">
                                    <li>{{ $message }}</li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="marketable_number" class="h6">تعداد</label>
                                        <input type="text" name="marketable_number" id="marketable_number" class="form-control form-control-sm" value="{{ old('marketable_number') }}">
                                </div>
                                @error('marketable_number')
                                <div class="alert alert-danger">
                                    <li>{{ $message }}</li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="description" class="h6">توضیحات</label>
                                    <textarea name="description" id="description" role="4" class="form-control form-control-sm">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
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
