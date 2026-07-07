<section class="address-add-wrapper">

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
