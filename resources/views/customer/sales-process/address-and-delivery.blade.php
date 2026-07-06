@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>مدیریت آدرس ها</title>
    <style>
        /* استایل‌های اضافی برای Tailwind */
        .address-add-button {
            @apply w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-3 px-6 rounded-xl shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 flex items-center justify-center gap-2 border-0;
        }

        .address-add-button i {
            @apply text-lg;
        }

        .form-control:focus, .form-select:focus {
            @apply shadow-none;
        }

        /* انیمیشن برای چک‌باکس */
        .form-switch .form-check-input {
            width: 2.5rem;
            height: 1.3rem;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #22c55e;
            border-color: #22c55e;
        }

        /* استایل خطاها */
        .text-danger {
            @apply text-red-500 text-xs mt-1;
        }

        /* انیمیشن مودال */
        .modal.fade .modal-dialog {
            transform: scale(0.8) translateY(-20px);
            transition: all 0.3s ease;
        }

        .modal.show .modal-dialog {
            transform: scale(1) translateY(0);
        }
    </style>
@endsection

@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب آدرس و مشخصات گیرنده
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>

                                <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <secrion>
                                        پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                    </secrion>
                                </section>


                                <section class="address-select">
                                    @foreach(auth()->user()->addresses()->get() as $address)
                                        <input type="radio" name="address" value="2" id="a2"/>
                                        <label for="a2" class="address-wrapper mb-2 p-2">
                                            <section class="mb-2">
                                                <i class="fa fa-map-marker-alt mx-1"></i>
                                                آدرس : {{ $address->address }}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-user-tag mx-1"></i>
                                                گیرنده : {{ $address->fullName }}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-mobile-alt mx-1"></i>
                                                موبایل گیرنده : {{ $address->mobile }}
                                            </section>
                                            <a class="" href="#"><i class="fa fa-edit"></i> ویرایش آدرس</a>
                                            <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                        </label>
                                    @endforeach
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                            <ul>
                                                <li>
                                                    <div class="alert alert-danger">
                                                        {{ $error }}
                                                    </div>
                                                </li>
                                            </ul>
                                        @endforeach
                                    @else

                                    @endif

                                        <section class="address-add-wrapper">
                                            <!-- دکمه ایجاد آدرس جدید -->
                                            <button class="address-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-address">
                                                <i class="fas fa-plus-circle"></i> ایجاد آدرس جدید
                                            </button>

                                            <!-- مودال ایجاد آدرس جدید -->
                                            <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                                                <section class="modal-dialog modal-dialog-centered modal-lg">
                                                    <section class="modal-content border-0 shadow-lg rounded-4">
                                                        <!-- هدر مودال -->
                                                        <section class="modal-header bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-4 px-5 py-3 border-0">
                                                            <h5 class="modal-title fw-bold" id="add-address-label">
                                                                <i class="fas fa-map-marker-alt me-2"></i> ایجاد آدرس جدید
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </section>

                                                        <!-- فرم -->
                                                        <form class="row g-3 p-4" action="{{ route('customer.sales-process.add-address') }}" method="POST">
                                                            @csrf

                                                            <!-- بدنه مودال -->
                                                            <section class="modal-body p-0">
                                                                <!-- کارت اطلاعات آدرس -->
                                                                <div class="bg-blue-50/50 rounded-3 p-4 mb-4 border border-blue-100">
                                                                    <h6 class="text-blue-800 fw-bold mb-3">
                                                                        <i class="fas fa-location-dot me-2"></i> اطلاعات آدرس
                                                                    </h6>

                                                                    <div class="row g-3">
                                                                        <!-- استان -->
                                                                        <div class="col-md-6">
                                                                            <label for="province" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-map me-1 text-blue-600"></i> استان
                                                                            </label>
                                                                            <select name="province_id" class="form-select form-select-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="province">
                                                                                <option value="" selected>استان را انتخاب کنید</option>
                                                                                @foreach($provinces as $province)
                                                                                    <option value="{{ $province->id }}" data-url="{{ route('customer.sales-process.get-cities', $province->id) }}">{{ $province->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('province_id')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- شهر -->
                                                                        <div class="col-md-6">
                                                                            <label for="city" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-city me-1 text-blue-600"></i> شهر
                                                                            </label>
                                                                            <select name="city_id" class="form-select form-select-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="city">
                                                                                <option value="" selected>شهر را انتخاب کنید</option>
                                                                            </select>
                                                                            @error('city_id')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- آدرس -->
                                                                        <div class="col-12">
                                                                            <label for="address" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-home me-1 text-blue-600"></i> نشانی
                                                                            </label>
                                                                            <input name="address" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="address" placeholder="نشانی کامل" value="{{ old('address') }}">
                                                                            @error('address')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- کد پستی -->
                                                                        <div class="col-md-6">
                                                                            <label for="postal_code" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-mailbox me-1 text-blue-600"></i> کد پستی
                                                                            </label>
                                                                            <input name="postal_code" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="postal_code" placeholder="کد پستی ۱۰ رقمی" value="{{ old('postal_code') }}">
                                                                            @error('postal_code')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- پلاک و واحد -->
                                                                        <div class="col-md-3">
                                                                            <label for="no" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-hashtag me-1 text-blue-600"></i> پلاک
                                                                            </label>
                                                                            <input name="no" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="no" placeholder="پلاک" value="{{ old('no') }}">
                                                                            @error('no')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <label for="unit" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-layer-group me-1 text-blue-600"></i> واحد
                                                                            </label>
                                                                            <input name="unit" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="unit" placeholder="واحد" value="{{ old('unit') }}">
                                                                            @error('unit')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- خط جداکننده -->
                                                                <div class="border-t-2 border-dashed border-gray-200 my-4"></div>

                                                                <!-- کارت اطلاعات گیرنده -->
                                                                <div class="bg-green-50/50 rounded-3 p-4 border border-green-100">
                                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                                        <h6 class="text-green-800 fw-bold mb-0">
                                                                            <i class="fas fa-user me-2"></i> اطلاعات گیرنده
                                                                        </h6>
                                                                        <div class="form-check form-switch">
                                                                            <!-- فیلد مخفی برای ارسال مقدار false وقتی چک‌باکس تیک ندارد -->
                                                                            <input type="hidden" name="receiver" value="off">
                                                                            <input name="receiver" class="form-check-input border-2 border-green-400 focus:ring-green-500" type="checkbox" id="receiver" value="on" onchange="toggleReceiverFields(this)">
                                                                            <label class="form-check-label fw-semibold text-gray-700" for="receiver">
                                                                                <i class="fas fa-check-circle text-green-600"></i> گیرنده سفارش خودم هستم
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row g-3" id="receiver-fields">
                                                                        <!-- نام گیرنده -->
                                                                        <div class="col-md-6">
                                                                            <label for="first_name" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-user-pen me-1 text-green-600"></i> نام گیرنده
                                                                            </label>
                                                                            <input name="recipient_first_name" type="text" class="form-control form-control-sm border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 rounded-lg" id="first_name" placeholder="نام گیرنده" value="{{ old('recipient_first_name') }}">
                                                                            @error('recipient_first_name')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- نام خانوادگی گیرنده -->
                                                                        <div class="col-md-6">
                                                                            <label for="last_name" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-user-pen me-1 text-green-600"></i> نام خانوادگی گیرنده
                                                                            </label>
                                                                            <input name="recipient_last_name" type="text" class="form-control form-control-sm border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 rounded-lg" id="last_name" placeholder="نام خانوادگی گیرنده" value="{{ old('recipient_last_name') }}">
                                                                            @error('recipient_last_name')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- شماره موبایل -->
                                                                        <div class="col-md-6">
                                                                            <label for="mobile" class="form-label fw-semibold text-gray-700">
                                                                                <i class="fas fa-phone me-1 text-green-600"></i> شماره موبایل
                                                                            </label>
                                                                            <input name="mobile" type="text" class="form-control form-control-sm border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 rounded-lg" id="mobile" placeholder="۰۹۱۲۱۲۳۴۵۶۷" value="{{ old('mobile') }}">
                                                                            @error('mobile')
                                                                            <small class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>

                                                            <!-- فوتر مودال -->
                                                            <section class="modal-footer border-0 px-0 pt-3 pb-0 d-flex gap-2">
                                                                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-lg shadow-md hover:shadow-lg transition-all">
                                                                    <i class="fas fa-check me-2"></i> ثبت آدرس
                                                                </button>
                                                                <button type="button" class="btn btn-outline-danger px-4 py-2 fw-bold rounded-lg hover:bg-red-50 transition-all" data-bs-dismiss="modal">
                                                                    <i class="fas fa-times me-2"></i> انصراف
                                                                </button>
                                                            </section>
                                                        </form>
                                                    </section>
                                                </section>
                                            </section>
                                        </section>

                                </section>
                            </section>


                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نحوه ارسال
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="delivery-select ">

                                    <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر بگیرید.
                                        </secrion>
                                    </section>

                                    <input type="radio" name="delivery_type" value="1" id="d1"/>
                                    <label for="d1" class="col-12 col-md-4 delivery-wrapper mb-2 pt-2">
                                        <section class="mb-2">
                                            <i class="fa fa-shipping-fast mx-1"></i>
                                            پست پیشتاز
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            تامین کالا از 4 روز کاری آینده
                                        </section>
                                    </label>

                                    <input type="radio" name="delivery_type" value="2" id="d2"/>
                                    <label for="d2" class="col-12 col-md-4 delivery-wrapper mb-2 pt-2">
                                        <section class="mb-2">
                                            <i class="fa fa-shipping-fast mx-1"></i>
                                            تیپاکس
                                        </section>
                                        <section class="mb-2">
                                            <i class="fa fa-calendar-alt mx-1"></i>
                                            تامین کالا از 2 روز کاری آینده
                                        </section>
                                    </label>


                                </section>
                            </section>


                        </section>
                        @include('customer.sales-process.cart-modal')
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
@endsection

@section('script')
    <script src="{{ asset('customer-assets/js/address-and-delivery.js') }}"></script>
@endsection
