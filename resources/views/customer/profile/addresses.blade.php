@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>آدرس های کاربر {{ config('app.app_persian_name') }}</title>
@endsection

@section('content')
    <section class="bg-white rounded-2xl shadow-sm p-4 md:p-6 mb-4" dir="rtl"
             x-data="addressPage()" x-init="init()">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-location-dot text-indigo-600"></i>
                آدرس های من
            </h2>

            <button type="button"
                    @click="openAdd()"
                    class="hidden md:inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors">
                <i class="fa-solid fa-plus"></i>
                آدرس جدید
            </button>
        </div>

        {{-- Address list --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            @forelse(auth()->user()->addresses()->get() as $address)
                <div class="relative group border border-gray-200 hover:border-indigo-300 rounded-2xl p-4 transition-colors">

                    @if(!empty($address->is_default))
                        <span class="absolute -top-2 right-4 bg-emerald-500 text-white text-[11px] font-semibold px-2 py-0.5 rounded-full shadow-sm">
                        <i class="fa-solid fa-circle-check ms-1"></i>
                        آدرس ارسال پیش‌فرض
                    </span>
                    @endif

                    <div class="space-y-2 text-sm text-gray-700">
                        <div class="flex items-start gap-2">
                            <i class="fa-solid fa-map-marker-alt text-indigo-500 mt-0.5"></i>
                            <span class="leading-6">{{ $address->address }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-user-tag text-indigo-500"></i>
                            <span>گیرنده: {{ $address->recipient_first_name ?? '-' }} {{ $address->recipient_last_name ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-mobile-screen text-indigo-500"></i>
                            <span>موبایل گیرنده: {{ $address->mobile ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4 pt-3 border-t border-dashed border-gray-200">
                        <div class="flex items-center gap-3">
                            <button type="button"
                                    @click='openEdit(@json($address))'
                                    class="inline-flex items-center gap-1.5 text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                <i class="fa-solid fa-pen"></i>
                                ویرایش آدرس
                            </button>

                            <form method="POST"
                                  action="{{ route('customer.profile.delete-address', $address->id) }}"
                                  onsubmit="return confirm('آیا از حذف این آدرس اطمینان دارید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fa-solid fa-trash"></i>
                                    حذف
                                </button>
                            </form>
                        </div>

                        @if(!empty($address->is_default))
                            <span class="text-xs text-emerald-600 font-medium">
                            کالاها به این آدرس ارسال می‌شوند
                        </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 border border-dashed border-gray-300 rounded-2xl p-8 text-center text-gray-400">
                    <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                    <p>هیچ آدرسی ثبت نشده است</p>
                </div>
            @endforelse

            {{-- Add address dashed card --}}
            <button type="button"
                    @click="openAdd()"
                    class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-gray-300 hover:border-indigo-400 hover:bg-indigo-50/40 rounded-2xl p-6 text-gray-500 hover:text-indigo-600 transition-colors min-h-[140px]">
                <i class="fa-solid fa-circle-plus text-2xl"></i>
                <span class="text-sm font-semibold">ایجاد آدرس جدید</span>
            </button>
        </div>

        {{-- ============ MODAL (shared for add/edit) ============ --}}
        <div x-show="showModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             style="display:none">

            {{-- backdrop --}}
            <div class="absolute inset-0 bg-black/50" @click="close()"></div>

            <div class="relative bg-white w-full max-w-2xl rounded-2xl shadow-xl overflow-hidden"
                 @click.stop>

                {{-- header --}}
                <div class="flex items-center justify-between px-5 py-4 bg-gradient-to-l from-indigo-600 to-indigo-500 text-white">
                    <h5 class="font-bold flex items-center gap-2">
                        <i class="fa-solid" :class="mode === 'edit' ? 'fa-pen' : 'fa-plus'"></i>
                        <span x-text="mode === 'edit' ? 'ویرایش آدرس' : 'ایجاد آدرس جدید'"></span>
                    </h5>
                    <button type="button" @click="close()" class="text-white/80 hover:text-white">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                {{-- form --}}
                <form method="POST"
                      :action="mode === 'edit' ? '{{ route('customer.sales-process.update-address') }}' : '{{ route('customer.sales-process.add-address') }}'"
                      class="p-5 space-y-5">
                    @csrf
                    <input type="hidden" name="_method" :value="mode === 'edit' ? 'PUT' : 'POST'">
                    <input type="hidden" name="id" x-model="form.id">

                    {{-- Address info card --}}
                    <div class="bg-indigo-50/60 border border-indigo-100 rounded-xl p-4 space-y-4">
                        <h6 class="text-indigo-800 font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-location-dot"></i>
                            اطلاعات آدرس
                        </h6>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">استان</label>
                                <select name="province_id" x-model="form.province_id" @change="onProvinceChange()"
                                        class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                    <option value="">استان را انتخاب کنید</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">شهر</label>
                                <select name="city_id" x-model="form.city_id"
                                        :disabled="!form.province_id || loadingCities"
                                        class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 disabled:bg-gray-100">
                                    <template x-if="!form.province_id">
                                        <option value="">ابتدا استان را انتخاب کنید</option>
                                    </template>
                                    <template x-if="form.province_id && loadingCities">
                                        <option value="">در حال دریافت شهرها...</option>
                                    </template>
                                    <template x-if="form.province_id && !loadingCities && citiesLoadError">
                                        <option value="">خطا در دریافت شهرها</option>
                                    </template>
                                    <template x-if="form.province_id && !loadingCities && !citiesLoadError && cities.length === 0">
                                        <option value="">شهری یافت نشد</option>
                                    </template>
                                    <template x-if="form.province_id && !loadingCities && !citiesLoadError && cities.length > 0">
                                        <option value="">انتخاب شهر...</option>
                                    </template>
                                    <template x-for="city in cities" :key="city.id">
                                        <option :value="city.id" x-text="city.name"></option>
                                    </template>
                                </select>
                                @error('city_id')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">نشانی</label>
                                <input type="text" name="address" x-model="form.address" placeholder="نشانی کامل"
                                       class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                @error('address')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">کد پستی</label>
                                <input type="text" name="postal_code" x-model="form.postal_code" placeholder="کد پستی"
                                       class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                @error('postal_code')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">پلاک</label>
                                    <input type="text" name="no" x-model="form.no" placeholder="پلاک"
                                           class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                    @error('no')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">واحد</label>
                                    <input type="text" name="unit" x-model="form.unit" placeholder="واحد"
                                           class="w-full text-sm rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                                    @error('unit')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recipient info card --}}
                    <div class="bg-emerald-50/60 border border-emerald-100 rounded-xl p-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <h6 class="text-emerald-800 font-bold text-sm flex items-center gap-2">
                                <i class="fa-solid fa-user"></i>
                                اطلاعات گیرنده
                            </h6>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 cursor-pointer">
                                <input type="hidden" name="receiver" value="off">
                                <input type="checkbox" name="receiver" value="on"
                                       x-model="form.receiverIsMe"
                                       true-value="on" false-value="off"
                                       class="rounded text-emerald-600 focus:ring-emerald-500">
                                گیرنده سفارش خودم هستم
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="form.receiverIsMe !== 'on'" x-cloak>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">نام گیرنده</label>
                                <input type="text" name="recipient_first_name" x-model="form.recipient_first_name" placeholder="نام گیرنده"
                                       class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                                @error('recipient_first_name')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">نام خانوادگی گیرنده</label>
                                <input type="text" name="recipient_last_name" x-model="form.recipient_last_name" placeholder="نام خانوادگی گیرنده"
                                       class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                                @error('recipient_last_name')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">شماره موبایل</label>
                                <input type="text" name="mobile" x-model="form.mobile" placeholder="۰۹۱۲۱۲۳۴۵۶۷"
                                       class="w-full text-sm rounded-lg border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200">
                                @error('mobile')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- footer --}}
                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit"
                                class="flex-1 md:flex-none bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2.5 rounded-xl transition-colors">
                            <i class="fa-solid fa-check ms-1"></i>
                            ثبت آدرس
                        </button>
                        <button type="button" @click="close()"
                                class="flex-1 md:flex-none border border-gray-300 hover:bg-gray-50 text-gray-600 font-bold px-6 py-2.5 rounded-xl transition-colors">
                            <i class="fa-solid fa-xmark ms-1"></i>
                            انصراف
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- mobile floating add button --}}
        <button type="button" @click="openAdd()"
                class="md:hidden fixed bottom-6 left-6 z-40 bg-indigo-600 hover:bg-indigo-700 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-xl">
            <i class="fa-solid fa-plus"></i>
        </button>
    </section>
@endsection

@section('script')
    <style>[x-cloak] { display: none !important; }</style>

    <script>
        function addressPage() {
            return {
                showModal: false,
                mode: 'add', // 'add' | 'edit'
                cities: [],
                loadingCities: false,
                citiesLoadError: false,
                citiesUrlTemplate: "{{ route('customer.sales-process.get-cities', ['province' => 'PROVINCE_ID_PLACEHOLDER']) }}",
                form: {
                    id: '',
                    province_id: '',
                    city_id: '',
                    address: '',
                    postal_code: '',
                    no: '',
                    unit: '',
                    receiverIsMe: 'off',
                    recipient_first_name: '',
                    recipient_last_name: '',
                    mobile: '',
                },

                init() {
                    @if($errors->any())
                    // Reopen the correct modal after a failed validation redirect
                    this.mode = '{{ old("id") ? "edit" : "add" }}';
                    this.form = {
                        id: '{{ old("id") }}',
                        province_id: '{{ old("province_id") }}',
                        city_id: '{{ old("city_id") }}',
                        address: @json(old('address', '')),
                        postal_code: '{{ old("postal_code") }}',
                        no: '{{ old("no") }}',
                        unit: '{{ old("unit") }}',
                        receiverIsMe: '{{ old("receiver", "off") }}',
                        recipient_first_name: @json(old('recipient_first_name', '')),
                        recipient_last_name: @json(old('recipient_last_name', '')),
                        mobile: '{{ old("mobile") }}',
                    };
                    this.showModal = true;
                    if (this.form.province_id) {
                        this.onProvinceChange(this.form.city_id);
                    }
                    @endif
                },

                resetForm() {
                    this.form = {
                        id: '', province_id: '', city_id: '', address: '',
                        postal_code: '', no: '', unit: '', receiverIsMe: 'off',
                        recipient_first_name: '', recipient_last_name: '', mobile: '',
                    };
                    this.cities = [];
                },

                openAdd() {
                    this.mode = 'add';
                    this.resetForm();
                    this.showModal = true;
                },

                openEdit(address) {
                    this.mode = 'edit';
                    this.form = {
                        id: address.id,
                        province_id: address.province_id ?? '',
                        city_id: address.city_id ?? '',
                        address: address.address ?? '',
                        postal_code: address.postal_code ?? '',
                        no: address.no ?? '',
                        unit: address.unit ?? '',
                        receiverIsMe: (address.recipient_first_name || address.recipient_last_name || address.mobile) ? 'off' : 'on',
                        recipient_first_name: address.recipient_first_name ?? '',
                        recipient_last_name: address.recipient_last_name ?? '',
                        mobile: address.mobile ?? '',
                    };
                    this.showModal = true;
                    if (this.form.province_id) {
                        this.onProvinceChange(this.form.city_id);
                    }
                },

                close() {
                    this.showModal = false;
                },

                onProvinceChange(preselectCityId = null) {
                    this.form.city_id = '';
                    this.cities = [];
                    this.citiesLoadError = false;

                    if (!this.form.province_id) {
                        return;
                    }

                    const url = this.citiesUrlTemplate.replace('PROVINCE_ID_PLACEHOLDER', this.form.province_id);
                    this.loadingCities = true;

                    fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                        .then(async res => {
                            const raw = await res.text();
                            let parsed;
                            try {
                                parsed = JSON.parse(raw);
                            } catch (e) {
                                console.error('پاسخ سرور JSON نبود. status:', res.status, 'body:', raw);
                                throw new Error('invalid-json');
                            }
                            if (!res.ok) {
                                console.error('پاسخ سرور با خطا برگشت. status:', res.status, 'body:', parsed);
                                throw new Error('http-error');
                            }
                            return parsed;
                        })
                        .then(response => {
                            if (!response.status) {
                                console.error('سرور status:false برگردوند:', response);
                                this.citiesLoadError = true;
                                this.cities = [];
                                return;
                            }
                            this.cities = response.cities ?? [];
                            if (preselectCityId) {
                                this.form.city_id = String(preselectCityId);
                            }
                        })
                        .catch(err => {
                            console.error('خطا در دریافت شهرها:', err);
                            this.citiesLoadError = true;
                            this.cities = [];
                        })
                        .finally(() => {
                            this.loadingCities = false;
                        });
                },
            };
        }
    </script>
@endsection
