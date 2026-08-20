@extends('admin.layouts.master')

@section('head-tag')
    <title>فرم کالا</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">فرم کالا</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">فرم کالا</h1>
                    <p class="mt-2 text-sm leading-6 text-slate-500">مدیریت فیلدهای مشخصات کالا و مقادیر وابسته به هر دسته.</p>
                </div>
                <a href="{{ route('admin.market.property.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-cyan-700">
                    <i class="fas fa-plus"></i>
                    ایجاد فرم جدید
                </a>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">لیست فرم‌ها</h2>
                    <p class="mt-1 text-sm text-slate-500">هر فرم را می‌توان ویرایش یا وارد صفحه مقادیر آن شد.</p>
                </div>
                <div class="w-full max-w-sm">
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input type="text" id="search" placeholder="جستجو" class="w-full bg-transparent text-sm outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-right text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 font-semibold">#</th>
                                <th class="px-4 py-3 font-semibold">نام فرم</th>
                                <th class="px-4 py-3 font-semibold">واحد اندازه گیری</th>
                                <th class="px-4 py-3 font-semibold">فرم والد</th>
                                <th class="px-4 py-3 font-semibold">تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($categoryAttributes as $categoryAttribute)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-4 py-4 font-semibold text-slate-500">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-4 font-medium text-slate-900">{{ $categoryAttribute->name }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $categoryAttribute->unit }}</td>
                                    <td class="px-4 py-4 text-slate-600">{{ $categoryAttribute->category->name }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.market.property.edit', $categoryAttribute->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                                <i class="fas fa-pen"></i>
                                                ویرایش
                                            </a>
                                            <a href="{{ route('admin.market.value.index', $categoryAttribute->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                                <i class="fas fa-list"></i>
                                                ویژگی ها
                                            </a>
                                            <form method="POST" action="{{ route('admin.market.property.destroy', $categoryAttribute->id) }}" id="delete-form-{{ $categoryAttribute->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $categoryAttribute->id }}">
                                                    <i class="fas fa-trash"></i>
                                                    حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-16 text-center text-slate-500">هنوز فرمی ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $categoryAttributes->links() }}
            </div>
        </section>
    </div>
@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
