@extends('admin.layouts.master')


@section('head-tag')
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<title>ویرایش تخفیف عمومی</title>
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
            <a href="{{ route('admin.market.discount.commonDiscount') }}">تخفیف عمومی</a>
        </li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">
            ویرایش تخفیف عمومی
        </li>
    </ol>
</nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش تخفیف عمومی
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.commonDiscount.update' , $commonDiscount->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="discount" class="h6">درصد تخفیف</label>
                                        <input type="text" name="discount" id="discount" class="form-control form-control-sm" value="{{ old('discount' , $commonDiscount->discount) }}">
                                </div>
                                @error('discount')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="discount_ceiling" class="h6">حداکثر تخفیف</label>
                                        <input type="text" name="discount_ceiling" id="discount_ceiling" class="form-control form-control-sm" value="{{ old('discount_ceiling' , $commonDiscount->discount_ceiling) }}">
                                </div>
                                @error('discount_ceiling')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="discount_floor" class="h6">حداقل مبلغ خرید</label>
                                    <input type="text" name="discount_floor" id="discount_floor" class="form-control form-control-sm" value="{{ old('discount_floor' , $commonDiscount->discount_floor) }}">
                                </div>
                                @error('discount_floor')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title" class="h6">عنوان مناسبت</label>
                                        <input type="text" name="title" id="title" class="form-control form-control-sm" value="{{ old('title' , $commonDiscount->title) }}">
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
                                    <label for="start_date" class="h6 d-flex">تاریخ شروع</label>
                                    <input type="text" id="start_date" name="start_date" class="form-control form-control-sm jalali-input" placeholder="انتخاب تاریخ شروع">
                                    <i class="fa fa-calendar calendar-icon position-absolute"
                                       data-target="#start_date"
                                       style="top: 60%; left: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('start_date')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="h6 d-flex">تاریخ پایان</label>
                                    <input type="text" id="end_date" name="end_date" class="form-control form-control-sm jalali-input" placeholder="انتخاب تاریخ پایان">
                                    <i class="fa fa-calendar calendar-icon position-absolute"
                                       data-target="#end_date"
                                       style="top: 60%; left: 20px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('end_date')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="status" class="h6">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="default">انتخاب کنید</option>
                                        <option value="0" @if(old('status' , $commonDiscount->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $commonDiscount->status) == 1) selected @endif>فعال</option>
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
