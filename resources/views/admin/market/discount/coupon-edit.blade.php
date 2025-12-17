@extends('admin.layouts.master')


@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ویرایش کوپن تخفیف</title>
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
                <a href="{{ route('admin.market.discount.copan') }}">کوپن تخفیف</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">
                ویرایش کوپن تخفیف
            </li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کوپن تخفیف
                    </h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.copan') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.coupon.update' , $coupon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="code" class="h6">کد کوپن</label>
                                    <input type="text" name="code" id="code" class="form-control form-control-sm" value="{{ old('code' , $coupon->code) }}">
                                    <i class="fa fa-bolt" onclick="randomDiscount()"> ایجاد کد رندوم</i>
                                </div>
                                @error('code')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="type" class="h6">نوع کوپن</label>
                                    <select name="type" id="type" class="form-control form-control-sm" value="{{ old('type') }}">
                                        <option value="0" @if(old('type' , $coupon->type) == '0') selected @endif>عمومی</option>
                                        <option value="1" @if(old('type' , $coupon->type) == '1') selected @endif>خصوصی</option>
                                    </select>
                                </div>
                                @error('type')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="user_id" class="h6">کاربران</label>
                                    <select name="user_id" id="users" class="form-control form-control-sm" {{ $coupon->type == 1 ? 'disabled' : '' }}>
                                    </select>
                                </div>
                                @error('user_id')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="h6">میزان تخفیف</label>
                                    <input type="text" name="amount" id="amount" class="form-control form-control-sm" value="{{ old('amount' , $coupon->amount) }}">
                                </div>
                                @error('amount')
                                <div class="alert alert-danger">
                                    <li>
                                        {{ $message }}
                                    </li>
                                </div>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group ">
                                    <label for="amount_type" class="h6">نوع تخفیف</label>
                                    <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                        <option value="0" @if(old('amount_type' , $coupon->amount_type) == "0") selected @endif>درصدی</option>
                                        <option value="1" @if(old('amount_type' , $coupon->amount_type) == "1") selected @endif>عددی</option>
                                    </select>
                                </div>
                                @error('amount_type')
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
                                    <input type="text" name="discount_ceiling" id="discount_ceiling" class="form-control form-control-sm" value="{{ old('discount_ceiling' , $coupon->discount_ceiling) }}">
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
                                        <option value="0" @if(old('status' , $coupon->status) == 0) selected @endif>غیر قعال</option>
                                        <option value="1" @if(old('status' , $coupon->status) == 1) selected @endif>فعال</option>
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

            document.getElementsByName('code')[0].value = result;
        }
        $('#type').on('change', function () {
            let type = $(this).val();

            if (type === '1') {

                $('#users').prop('disabled', false).html('<option>در حال بارگذاری...</option>');

                $.ajax({
                    url: "{{ route('admin.market.discount.users') }}",
                    type: "GET",
                    dataType: "json",
                    success: function (response) {

                        let options = '<option value="">انتخاب کنید</option>';
                        response.forEach(user => {
                            options += `<option value="${user.id}">${user.email}</option>`;
                        });

                        $('#users')
                            .html(options)
                            .select2({
                                placeholder: "جستجو کاربر...",
                                width: '100%',
                                dir: 'rtl'
                            });
                    },
                    error: function () {
                        $('#users').html('<option>خطا در دریافت کاربران</option>');
                    }
                });

            } else {
                $('#users').prop('disabled', true).html('');
                $('#users').select2('destroy'); // پاکسازی select2 برای حالت عمومی
            }
        });
    </script>
@endsection
