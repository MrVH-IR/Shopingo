@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>پروفایل کاربری {{ config('app.app_persian_name') }}</title>
@endsection

@section('content')
    <div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }" x-cloak>

        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6" style="margin-right: 100px; margin-left: 100px; margin-bottom: 20px">

            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-user text-orange-500"></i>
                    اطلاعات حساب
                </h2>
                <button type="button" @click="open = true"
                        class="inline-flex items-center gap-1.5 text-sm font-medium text-orange-600 hover:text-orange-700 transition-colors duration-200">
                    <i class="fa-solid fa-pen"></i>
                    ویرایش حساب
                </button>
            </div>

            <!-- Info grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6">
                <div class="border-b border-gray-100 py-3">
                    <div class="text-xs text-gray-400 mb-1">نام</div>
                    <div class="text-gray-700 font-medium">{{ auth()->user()->first_name ?? '-' }}</div>
                </div>
                <div class="border-b border-gray-100 py-3">
                    <div class="text-xs text-gray-400 mb-1">نام خانوادگی</div>
                    <div class="text-gray-700 font-medium">{{ auth()->user()->last_name ?? '-' }}</div>
                </div>
                <div class="border-b border-gray-100 py-3 sm:border-b-0">
                    <div class="text-xs text-gray-400 mb-1">شماره تلفن همراه</div>
                    <div class="text-gray-700 font-medium">{{ auth()->user()->mobile ?? '-' }}</div>
                </div>
                <div class="border-b border-gray-100 py-3 sm:border-b-0">
                    <div class="text-xs text-gray-400 mb-1">ایمیل</div>
                    <div class="text-gray-700 font-medium">{{ auth()->user()->email ?? '-' }}</div>
                </div>
                <div class="py-3">
                    <div class="text-xs text-gray-400 mb-1">کد ملی</div>
                    <div class="text-gray-700 font-medium">{{ auth()->user()->national_code ?? '-' }}</div>
                </div>
            </div>

        </section>

        <!-- Modal -->
        <div x-show="open"
             x-transition.opacity
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4"
             style="display: none;">

            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 @click.outside="open = false"
                 class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 relative">

                <button type="button" @click="open = false"
                        class="absolute top-4 left-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <h3 class="text-base font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-user-pen text-orange-500"></i>
                    ویرایش حساب
                </h3>

                <form method="POST" action="{{ route('customer.profile.profile.update') }}" class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="first_name" class="block text-sm text-gray-600 mb-1.5">نام</label>
                        <input type="text" id="first_name" name="first_name"
                               value="{{ old('first_name', auth()->user()->first_name) }}"
                               class="w-full rounded-xl border px-4 py-2.5 text-sm outline-none transition-colors duration-200
                                  focus:ring-2 focus:ring-orange-100
                                  {{ $errors->has('first_name') ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-orange-400' }}">
                        @error('first_name')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm text-gray-600 mb-1.5">نام خانوادگی</label>
                        <input type="text" id="last_name" name="last_name"
                               value="{{ old('last_name', auth()->user()->last_name) }}"
                               class="w-full rounded-xl border px-4 py-2.5 text-sm outline-none transition-colors duration-200
                                  focus:ring-2 focus:ring-orange-100
                                  {{ $errors->has('last_name') ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-orange-400' }}">
                        @error('last_name')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="national_code" class="block text-sm text-gray-600 mb-1.5">کد ملی</label>
                        <input type="text" id="national_code" name="national_code" inputmode="numeric" maxlength="10"
                               value="{{ old('national_code', auth()->user()->national_code) }}"
                               class="w-full rounded-xl border px-4 py-2.5 text-sm outline-none transition-colors duration-200
                                  focus:ring-2 focus:ring-orange-100
                                  {{ $errors->has('national_code') ? 'border-red-400 focus:border-red-400' : 'border-gray-200 focus:border-orange-400' }}">
                        @error('national_code')
                        <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 mt-2">
                        <button type="submit"
                                class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-2.5 rounded-xl transition-colors duration-200">
                            ذخیره تغییرات
                        </button>
                        <button type="button" @click="open = false"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium py-2.5 rounded-xl transition-colors duration-200">
                            انصراف
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
