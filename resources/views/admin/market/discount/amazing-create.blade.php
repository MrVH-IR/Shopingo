@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>افزودن به فروش شگفت انگیز</title>
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
            <a href="{{ route('admin.market.discount.amazingSale') }}">فروش شگفت انگیز</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            افزودن به فروش شگفت انگیز
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                       افزودن به فروش شگفت انگیز
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.amazingSale') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.amazingSale.store') }}" method="POST">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="product" class="h6">نام کالا</label>
                                    <select name="product_id" id="product" class="form-control form-control-sm">
                                        <option>نام کالا را انتخاب کنید...</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected @endif>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="percentage" class="h6">درصد تخفیف</label>
                                        <input type="text" name="percentage" id="percentage" class="form-control form-control-sm">
                                </div>
                                @error('percentage')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="start_at" class="h6 d-flex">تاریخ شروع</label>
                                    <input type="text" id="start_at" name="start_at" class="form-control form-control-sm jalali-input" placeholder="انتخاب تاریخ شروع">
                                    <i class="fa fa-calendar calendar-icon position-absolute"
                                       data-target="#start_at"
                                       style="top: 60%; left: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('start_at')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="end_at" class="h6 d-flex">تاریخ پایان</label>
                                    <input type="text" id="end_at" name="end_at" class="form-control form-control-sm jalali-input" placeholder="انتخاب تاریخ پایان">
                                    <i class="fa fa-calendar calendar-icon position-absolute"
                                       data-target="#end_at"
                                       style="top: 60%; left: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('end_at')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="status" class="h6">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
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
    function randomDiscount(length = 10)
    {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0 ; i < length ; i++){
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }

        document.getElementsByName('discount')[0].value = result;
    }
</script>
@endsection
