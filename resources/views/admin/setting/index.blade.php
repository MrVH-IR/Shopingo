@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection

@section('content')
    <div class="space-y-6">
        @include('admin.components.ui.page-header', [
            'title' => 'تنظیمات سایت',
            'description' => 'مدیریت عنوان، توضیحات، کلمات کلیدی، لوگو و favicon سایت.',
            'breadcrumbs' => [
                ['label' => 'خانه', 'url' => route('admin.home')],
                ['label' => 'تنظیمات'],
            ],
            'actionLabel' => 'ایجاد تنظیمات',
            'actionDisabled' => true,
            'actionIcon' => 'fas fa-plus',
        ])

        <section class="animate__animated animate__fadeInUp rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">اطلاعات فعلی سایت</h2>
                    <p class="mt-1 text-sm text-slate-500">تنها یک رکورد تنظیمات فعال در این بخش مدیریت می‌شود.</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">#</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">نام سایت</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">توضیحات سایت</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">کلمات کلیدی</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">لوگو</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">آیکون</th>
                                <th class="px-5 py-3 text-right text-xs font-semibold text-slate-500">Optimization</th>
                                <th class="px-5 py-3 text-center text-xs font-semibold text-slate-500">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-5 py-4 text-sm font-semibold text-slate-900">{{ $setting->id }}</td>
                                <td class="px-5 py-4 text-sm font-medium text-slate-700">{{ $setting->title }}</td>
                                <td class="max-w-xs px-5 py-4 text-sm text-slate-600">{{ $setting->description }}</td>
                                <td class="max-w-xs px-5 py-4 text-sm text-slate-600">{{ $setting->keywords }}</td>
                                <td class="px-5 py-4">
                                    @if(isset($setting->logo))
                                        <img src="{{ asset($setting->logo) }}" data-large="{{ asset($setting->logo) }}" alt="{{ $setting->logo }}" class="preview-img h-16 w-16 cursor-pointer rounded-2xl border border-slate-200 object-contain bg-slate-50" loading="lazy">
                                    @else
                                        <span class="text-sm text-slate-400">بدون تصویر</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    @if(isset($setting->favicon))
                                        <img src="{{ asset($setting->favicon) }}" data-large="{{ asset($setting->favicon) }}" alt="{{ $setting->favicon }}" class="preview-img h-16 w-16 cursor-pointer rounded-2xl border border-slate-200 object-contain bg-slate-50" loading="lazy">
                                    @else
                                        <span class="text-sm text-slate-400">بدون تصویر</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <form action="{{ route('admin.setting.optimization') }}" method="POST">@csrf
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                                            <i class="fas fa-wand-magic-sparkles"></i>
                                            Optimize
                                        </button>
                                    </form>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <a href="{{ route('admin.setting.edit', $setting->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-4 py-3 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                        <i class="fas fa-pen"></i>
                                        ویرایش
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div id="imageModal" class="modal-overlay fixed inset-0 z-[70] hidden items-center justify-center bg-slate-950/80 px-4">
            <button type="button" class="close-btn absolute left-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-white text-slate-700 shadow-lg">
                <i class="fas fa-times"></i>
            </button>
            <img class="modal-content max-h-[85vh] max-w-4xl rounded-3xl object-contain shadow-2xl" id="modalImage" alt="preview">
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
@endsection
