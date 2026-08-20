@extends('admin.layouts.master')

@section('head-tag')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <title>ویرایش کوپن تخفیف</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.discount.copan') }}" class="hover:text-slate-900">کوپن تخفیف</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">ویرایش</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">ویرایش کوپن تخفیف</h1>
                </div>
                <a href="{{ route('admin.market.discount.copan') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700"><i class="fas fa-arrow-right"></i> بازگشت</a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form action="{{ route('admin.market.discount.coupon.update', $coupon->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="code" class="text-sm font-semibold text-slate-700">کد کوپن</label>
                        <div class="flex gap-2">
                            <input type="text" name="code" id="code" value="{{ old('code', $coupon->code) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <button type="button" onclick="randomDiscount()" class="rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white">رندوم</button>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="type" class="text-sm font-semibold text-slate-700">نوع کوپن</label>
                        <select name="type" id="type" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="0" @selected(old('type', $coupon->type) == 0)>عمومی</option>
                            <option value="1" @selected(old('type', $coupon->type) == 1)>خصوصی</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="users" class="text-sm font-semibold text-slate-700">کاربران</label>
                        <select name="user_id" id="users" class="select2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white" {{ $coupon->type == 0 ? 'disabled' : '' }}>
                            <option value="">انتخاب کنید</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id', $coupon->user_id) == $user->id)>{{ $user->email }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="amount" class="text-sm font-semibold text-slate-700">میزان تخفیف</label>
                        <input type="text" name="amount" id="amount" value="{{ old('amount', $coupon->amount) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                    </div>
                    <div class="space-y-2">
                        <label for="amount_type" class="text-sm font-semibold text-slate-700">نوع تخفیف</label>
                        <select name="amount_type" id="amount_type" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="0" @selected(old('amount_type', $coupon->amount_type) == 0)>درصدی</option>
                            <option value="1" @selected(old('amount_type', $coupon->amount_type) == 1)>عددی</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="discount_ceiling" class="text-sm font-semibold text-slate-700">حداکثر تخفیف</label>
                        <input type="text" name="discount_ceiling" id="discount_ceiling" value="{{ old('discount_ceiling', $coupon->discount_ceiling) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('discount_ceiling')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="status" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                            <option value="1" @selected(old('status', $coupon->status) == 1)>فعال</option>
                            <option value="0" @selected(old('status', $coupon->status) == 0)>غیرفعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="start_date" class="text-sm font-semibold text-slate-700">تاریخ شروع</label>
                        <input type="text" id="start_date" name="start_date" value="{{ old('start_date', $coupon->start_date ? \Morilog\Jalali\Jalalian::fromCarbon($coupon->start_date)->format('Y/m/d H:i:s') : '') }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('start_date')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="end_date" class="text-sm font-semibold text-slate-700">تاریخ پایان</label>
                        <input type="text" id="end_date" name="end_date" value="{{ old('end_date', $coupon->end_date ? \Morilog\Jalali\Jalalian::fromCarbon($coupon->end_date)->format('Y/m/d H:i:s') : '') }}" class="jalali-input w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white">
                        @error('end_date')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end border-t border-slate-100 pt-4">
                    <button class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white">ثبت</button>
                </div>
            </form>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/jalaliDatePicker.js') }}"></script>
    <script>
        function randomDiscount(length = 10) {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) result += chars.charAt(Math.floor(Math.random() * chars.length));
            document.getElementsByName('code')[0].value = result;
        }
        $('#type').on('change', function () {
            const type = $(this).val();
            if (type === '1') {
                const selectedUserId = $('#users').val() || '{{ old('user_id', $coupon->user_id) }}';
                $('#users').prop('disabled', false).html('<option>در حال بارگذاری...</option>');
                $.ajax({
                    url: "{{ route('admin.market.discount.users') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        let options = '<option value="">انتخاب کنید</option>';
                        response.forEach(user => {
                            const isSelected = String(user.id) === String(selectedUserId) ? 'selected' : '';
                            options += `<option value="${user.id}" ${isSelected}>${user.email}</option>`;
                        });
                        $('#users').html(options).select2({ placeholder: 'جستجو کاربر...', width: '100%', dir: 'rtl' });
                    }
                });
            } else {
                $('#users').prop('disabled', true).html('');
            }
        });

        $(function () {
            $('#type').trigger('change');
            jalaliDatepicker.startWatch({
                separatorChar: '/',
                time: true,
                dateFormat: 'YYYY/MM/DD HH:mm:ss'
            });
        });
    </script>
@endsection
