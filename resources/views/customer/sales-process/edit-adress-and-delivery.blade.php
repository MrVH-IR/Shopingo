<section class="modal fade" id="edit-address" tabindex="-1" aria-labelledby="edit-address-label" aria-hidden="true">
    <section class="modal-dialog modal-dialog-centered modal-lg">
        <section class="modal-content border-0 shadow-lg rounded-4">
            <section class="modal-header bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-4 px-5 py-3 border-0">
                <h5 class="modal-title fw-bold" id="edit-address-label">
                    <i class="fas fa-map-marker-alt me-2"></i> ویرایش آدرس
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </section>

            <form id="edit-address-form" class="row g-3 p-4" action="{{ route('customer.sales-process.update-address') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-address-id">

                <section class="modal-body p-0">
                    <div class="bg-blue-50/50 rounded-3 p-4 mb-4 border border-blue-100">
                        <h6 class="text-blue-800 fw-bold mb-3">
                            <i class="fas fa-location-dot me-2"></i> اطلاعات آدرس
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="edit-province" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-map me-1 text-blue-600"></i> استان
                                </label>
                                <select name="province_id" class="form-select form-select-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="edit-province">
                                    <option value="" selected>استان را انتخاب کنید</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}" data-url="{{ route('customer.sales-process.get-cities', $province->id) }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="edit-city" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-city me-1 text-blue-600"></i> شهر
                                </label>
                                <select name="city_id" class="form-select form-select-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="edit-city">
                                    <option value="" selected>شهر را انتخاب کنید</option>
                                </select>
                                @error('city_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="edit-address-input" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-home me-1 text-blue-600"></i> نشانی
                                </label>
                                <input name="address" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="edit-address-input" placeholder="نشانی کامل">
                                @error('address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="edit-postal_code" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-mailbox me-1 text-blue-600"></i> کد پستی
                                </label>
                                <input name="postal_code" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="edit-postal_code" placeholder="کد پستی ۱۰ رقمی">
                                @error('postal_code')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="edit-no" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-hashtag me-1 text-blue-600"></i> پلاک
                                </label>
                                <input name="no" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="edit-no" placeholder="پلاک">
                                @error('no')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="edit-unit" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-layer-group me-1 text-blue-600"></i> واحد
                                </label>
                                <input name="unit" type="text" class="form-control form-control-sm border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg" id="edit-unit" placeholder="واحد">
                                @error('unit')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t-2 border-dashed border-gray-200 my-4"></div>

                    <div class="bg-green-50/50 rounded-3 p-4 border border-green-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="text-green-800 fw-bold mb-0">
                                <i class="fas fa-user me-2"></i> اطلاعات گیرنده
                            </h6>
                            <div class="form-check form-switch">
                                <input type="hidden" name="receiver" value="off">
                                <input name="receiver" class="form-check-input border-2 border-green-400 focus:ring-green-500" type="checkbox" id="edit-receiver" value="on" onchange="toggleReceiverFields(this, 'edit-receiver-fields')">
                                <label class="form-check-label fw-semibold text-gray-700" for="edit-receiver">
                                    <i class="fas fa-check-circle text-green-600"></i> گیرنده سفارش خودم هستم
                                </label>
                            </div>
                        </div>

                        <div class="row g-3" id="edit-receiver-fields">
                            <div class="col-md-6">
                                <label for="edit-first_name" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-user-pen me-1 text-green-600"></i> نام گیرنده
                                </label>
                                <input name="recipient_first_name" type="text" class="form-control form-control-sm border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 rounded-lg" id="edit-first_name" placeholder="نام گیرنده">
                                @error('recipient_first_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="edit-last_name" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-user-pen me-1 text-green-600"></i> نام خانوادگی گیرنده
                                </label>
                                <input name="recipient_last_name" type="text" class="form-control form-control-sm border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 rounded-lg" id="edit-last_name" placeholder="نام خانوادگی گیرنده">
                                @error('recipient_last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="edit-mobile" class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-phone me-1 text-green-600"></i> شماره موبایل
                                </label>
                                <input name="mobile" type="text" class="form-control form-control-sm border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 rounded-lg" id="edit-mobile" placeholder="۰۹۱۲۱۲۳۴۵۶۷">
                                @error('mobile')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>

                <section class="modal-footer border-0 px-0 pt-3 pb-0 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-lg shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-check me-2"></i> ذخیره تغییرات
                    </button>
                    <button type="button" class="btn btn-outline-danger px-4 py-2 fw-bold rounded-lg hover:bg-red-50 transition-all" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> انصراف
                    </button>
                </section>
            </form>
        </section>
    </section>
</section>

<script>
    function toggleReceiverFields(checkbox, targetId = 'receiver-fields') {
        const fieldsContainer = document.getElementById(targetId);
        if (!fieldsContainer) return;

        const inputs = fieldsContainer.querySelectorAll('input');

        if (checkbox.checked) {
            fieldsContainer.style.display = 'none';
            inputs.forEach(input => input.value = '');
        } else {
            fieldsContainer.style.display = '';
        }
    }

    function loadCities(provinceSelectEl, citySelectEl, selectedCityId = null) {
        const selectedOption = provinceSelectEl.options[provinceSelectEl.selectedIndex];
        const url = selectedOption ? selectedOption.dataset.url : null;

        citySelectEl.innerHTML = '<option value="">ابتدا استان را انتخاب کنید</option>';

        if (!url) return Promise.resolve();

        return fetch(url, {
            headers: { 'Accept': 'application/json' }
        })
            .then(res => res.json())
            .then(response => {
                citySelectEl.innerHTML = '<option value="">انتخاب شهر...</option>';

                if (!response.status) {
                    citySelectEl.innerHTML = '<option value="">خطا در دریافت شهرها</option>';
                    return;
                }

                const cities = response.cities ?? [];

                if (cities.length === 0) {
                    citySelectEl.innerHTML += '<option value="">شهری یافت نشد</option>';
                    return;
                }

                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    if (selectedCityId && Number(selectedCityId) === Number(city.id)) {
                        option.selected = true;
                    }
                    citySelectEl.appendChild(option);
                });
            })
            .catch(err => {
                console.error('خطا در دریافت لیست شهرها:', err);
                citySelectEl.innerHTML = '<option value="">خطا در ارتباط با سرور</option>';
            });
    }

    document.getElementById('edit-province').addEventListener('change', function () {
        loadCities(this, document.getElementById('edit-city'));
    });
    function openEditAddressModal(data) {
        document.getElementById('edit-address-id').value = data.id;
        document.getElementById('edit-address-input').value = data.address ?? '';
        document.getElementById('edit-postal_code').value = data.postalCode ?? '';
        document.getElementById('edit-no').value = data.no ?? '';
        document.getElementById('edit-unit').value = data.unit ?? '';
        document.getElementById('edit-first_name').value = data.recipientFirstName ?? '';
        document.getElementById('edit-last_name').value = data.recipientLastName ?? '';
        document.getElementById('edit-mobile').value = data.mobile ?? '';

        // ست کردن استان و شهر
        const provinceSelect = document.getElementById('edit-province');
        provinceSelect.value = data.provinceId ?? '';
        loadCities(provinceSelect, document.getElementById('edit-city'), data.cityId);

        // ست کردن وضعیت گیرنده
        const receiverCheckbox = document.getElementById('edit-receiver');
        receiverCheckbox.checked = data.receiver === 'on';
        toggleReceiverFields(receiverCheckbox, 'edit-receiver-fields');

        // نمایش مودال
        const modalEl = document.getElementById('edit-address');
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }
</script>
