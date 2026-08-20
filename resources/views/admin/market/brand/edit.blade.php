@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش برند</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="relative isolate overflow-hidden px-6 py-7 sm:px-8">
                <div class="absolute inset-0 -z-10 bg-gradient-to-br from-slate-950 via-slate-900 to-cyan-900"></div>
                <div class="absolute right-0 top-0 -z-10 h-40 w-40 rounded-full bg-cyan-400/20 blur-3xl"></div>
                <div class="absolute bottom-0 left-1/3 -z-10 h-32 w-32 rounded-full bg-fuchsia-400/10 blur-3xl"></div>

                <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <nav class="mb-3 text-sm text-slate-300">
                            <a href="{{ route('admin.home') }}" class="transition hover:text-white">خانه</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <a href="#" class="transition hover:text-white">بخش فروش</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <a href="{{ route('admin.market.brand.index') }}" class="transition hover:text-white">برند</a>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">ویرایش برند</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base\">
                            اسم فارسی، اسم انگلیسی، تگ‌ها، وضعیت و لوگو را به.
                        </p>
                    </div>

                    <a href="{{ route('admin.market.brand.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-arrow-right text-cyan-700"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm\">
            <form id="form" action="{{ route('admin.market.brand.update' , $brand->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6\">
                @csrf
                @method('PUT')

                <div class="grid gap-6 lg:grid-cols-2\">
                    <div class="space-y-2\">
                        <label for="persian_name" class="text-sm font-semibold text-slate-700\">نام فارسی برند</label>
                        <input type="text" name="persian_name" id="persian_name" value="{{ old('persian_name' , $brand->persian_name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white\">
                        @error('persian_name')
                            <p class="text-sm text-rose-600\">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2\">
                        <label for="original_name" class="text-sm font-semibold text-slate-700\">نام انگلیسی برند</label>
                        <input type="text" name="original_name" id="original_name" value="{{ old('original_name' , $brand->original_name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white\">
                        @error('original_name')
                            <p class="text-sm text-rose-600\">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2\">
                        <label for="status" class="text-sm font-semibold text-slate-700\">وضعیت</label>
                        <select name="status" id="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white\">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $brand->status) == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status', $brand->status) == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600\">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2\">
                        <label for="tags" class="text-sm font-semibold text-slate-700\">نام تگ ها</label>
                        <input type="hidden" name="tags" id="tags" value="{{ old('tags', $brand->tags) }}\">
                        <select class="select2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white\" id="select_tags" multiple></select>
                        @error('tags')
                            <p class="text-sm text-rose-600\">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2\">
                        <label for="image" class="text-sm font-semibold text-slate-700\">لوگو</label>
                        <input type="file" name="image" id="image" accept="image/png,image/jpg,image/jpeg,image/webp,image/svg" class="w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700\">
                        @error('image')
                            <p class="text-sm text-rose-600\">{{ $message }}</p>
                        @enderror

                        <div class="mt-4\">
                            <p class="text-sm font-semibold text-slate-700 mb-3\">تصاویر فعلی</p>
                            <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4\">
                                @php
                                    $imageArrays = $brand->image && is_array($brand->image) && isset($brand->image['indexArray']) ? $brand->image['indexArray'] : [];
                                    $number = 1;
                                @endphp
                                @forelse($imageArrays as $key => $value)
                                    <label class="group cursor-pointer overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 transition hover:border-cyan-300\">
                                        <input type="radio" class="sr-only" name="currentImage" value="{{ $key }}" @checked(($brand->image['currentImage'] ?? null) == $key)>
                                        <img src="{{ asset($value) }}" alt="تصویر {{ $number }}" class="h-24 w-full object-cover transition group-hover:scale-[1.02]\">
                                        <span class="block px-3 py-2 text-center text-xs font-semibold text-slate-500\">تصویر {{ $number }}</span>
                                    </label>
                                    @php
                                        $number++;
                                    @endphp
                                @empty
                                    <label>هیچ عکسی وجود ندارد.</label>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-4\">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700\">
                        <i class="fas fa-save\"></i>
                        ثبت تغییرات
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
@endsection
