@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش بنر</title>
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
                            <a href="{{ route('admin.content.banner.index') }}" class="transition hover:text-white">بنرها</a>
                            <span class="mx-2 text-slate-500">/</span>
                            <span class="text-slate-100">ویرایش</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">ویرایش بنر</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">
                            عنوان، لینک، موقعیت و تصویر بنر را به‌روزرسانی کنید.
                        </p>
                    </div>

                    <a href="{{ route('admin.content.banner.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                        <i class="fas fa-arrow-right text-cyan-700"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form id="form" action="{{ route('admin.content.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-semibold text-slate-700">عنوان بنر</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                        @error('title')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="link" class="text-sm font-semibold text-slate-700">آدرس URL</label>
                        <input type="text" name="link" id="link" value="{{ old('link', $banner->link) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-cyan-500 focus:bg-white">
                        @error('link')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="position" class="text-sm font-semibold text-slate-700">موقعیت</label>
                        <select id="position" name="position" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            @foreach($banner::$position as $key => $value)
                                <option value="{{ $key }}" @selected(old('position', $banner->position) == $key)>{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('position')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="Category-Select" class="text-sm font-semibold text-slate-700">وضعیت</label>
                        <select name="status" id="Category-Select" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-cyan-500 focus:bg-white">
                            <option value="default">انتخاب کنید</option>
                            <option value="0" @selected(old('status', $banner->status) == 0)>غیر فعال</option>
                            <option value="1" @selected(old('status', $banner->status) == 1)>فعال</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 lg:col-span-2">
                        <label for="image" class="text-sm font-semibold text-slate-700">تصویر جدید</label>
                        <input type="file" name="image" id="image" accept="image/png,image/jpg,image/jpeg,image/webp,image/svg,image/gif,image/svg+xml" class="w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-cyan-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cyan-700">
                        @error('image')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-4 flex flex-col items-start gap-4 sm:flex-row sm:items-center">
                            <img src="#" id="preview" class="hidden h-40 w-40 rounded-3xl object-cover ring-1 ring-slate-200" alt="preview">
                            <div id="imageError" class="hidden rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700"></div>
                        </div>

                        @php $image = $banner->image; @endphp
                        @if(is_array($image) && isset($image['indexArray']))
                            <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-3">
                                @foreach($image['indexArray'] as $key => $value)
                                    <label class="group cursor-pointer overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 transition hover:border-cyan-300">
                                        <input type="radio" class="sr-only" name="currentImage" value="{{ $key }}" @checked(($image['currentImage'] ?? null) == $key)>
                                        <img src="{{ asset($value) }}" alt="{{ $banner->title }}" class="preview-img h-28 w-full object-cover transition group-hover:scale-[1.02]">
                                        <span class="block px-3 py-2 text-center text-xs font-semibold text-slate-500">تصویر {{ $loop->iteration }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @elseif(is_string($image) && !empty($image))
                            <div class="mt-4">
                                <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-50 px-4 py-3">
                                    <img src="{{ asset($image) }}" alt="{{ $banner->title }}" class="preview-img h-12 w-12 rounded-2xl object-cover ring-1 ring-slate-200">
                                    <span class="text-xs font-semibold text-cyan-700">تصویر فعلی</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                        <i class="fas fa-save"></i>
                        ثبت تغییرات
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/select2.js') }}"></script>
    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        const errorDiv = document.getElementById('imageError');

        imageInput.onchange = function() {
            if (errorDiv) {
                errorDiv.classList.add('hidden');
                errorDiv.textContent = '';
            }

            if (preview.src && preview.src !== '#') {
                URL.revokeObjectURL(preview.src);
            }

            const file = this.files[0];

            if (!file) {
                preview.classList.add('hidden');
                preview.src = '#';
                return;
            }

            const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp', 'image/svg+xml', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                if (errorDiv) {
                    errorDiv.classList.remove('hidden');
                    errorDiv.textContent = 'فرمت فایل نامعتبر است. فقط PNG, JPG, JPEG, WEBP, SVG, GIF مجاز هستند.';
                }
                preview.classList.add('hidden');
                preview.src = '#';
                this.value = '';
                return;
            }

            preview.classList.remove('hidden');
            preview.src = URL.createObjectURL(file);
        };
    </script>
@endsection
