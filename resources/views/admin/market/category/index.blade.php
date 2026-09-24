@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
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
                            <span class="text-slate-100">دسته بندی</span>
                        </nav>
                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">دسته بندی محصولات</h1>
                        <p class="mt-3 text-sm leading-7 text-slate-300 sm:text-base">مدیریت دسته بندی‌های محصولات فروشگاه.</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.market.category.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-lg shadow-black/10 transition hover:bg-cyan-50">
                            <i class="fas fa-plus text-cyan-700"></i>
                            ایجاد دسته بندی
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">لیست دسته بندی‌ها</h2>
                    <p class="mt-1 text-sm text-slate-500">دسته بندی‌های ثبت شده در فروشگاه.</p>
                </div>

                <div class="w-full max-w-sm">
                    <label for="search" class="sr-only">جستجو</label>
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                        <i class="fas fa-search text-slate-400"></i>
                        <input id="search" name="search" type="text" placeholder="جستجو..." class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400">
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                @forelse($productCategories as $productcategory)
                    <article class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                            <div class="flex min-w-0 items-start gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">
                                    <span class="text-sm font-black">{{ $loop->iteration }}</span>
                                </div>

                                <div class="min-w-0">
                                    <h3 class="text-base font-bold text-slate-900">{{ $productcategory->name }}</h3>

                                    <div class="mt-2 flex flex-wrap items-center gap-2">
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            دسته والد : {{ $productcategory->parent_id ? $productcategory->parent->name : 'منوی اصلی' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.market.category.edit', $productcategory->id) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-50 px-4 py-3 text-sm font-semibold text-amber-700 transition hover:bg-amber-100">
                                    <i class="fas fa-pen"></i>
                                    ویرایش
                                </a>

                                <form action="{{ route('admin.market.category.destroy', $productcategory->id) }}" method="POST" id="delete-form-{{ $productcategory->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete inline-flex items-center gap-2 rounded-2xl bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100" data-id="{{ $productcategory->id }}">
                                        <i class="fas fa-trash"></i>
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-slate-400 shadow-sm">
                            <i class="fas fa-folder-open text-xl"></i>
                        </div>
                        <h3 class="mt-4 text-base font-bold text-slate-900">هنوز دسته بندی ثبت نشده است</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-500">اولین دسته بندی محصولات را ایجاد کنید.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>

    {{ $productCategories->links('admin.layouts.pagination', ['title' => 'دسته بندی']) }}

@endsection

@section('script')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
