@extends('admin.layouts.master')

@section('head-tag')
    <title>کالا ها</title>
@endsection

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <nav class="mb-3 text-sm text-slate-500">
                        <a href="{{ route('admin.home') }}" class="hover:text-slate-900">خانه</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <a href="{{ route('admin.market.category.index') }}" class="hover:text-slate-900">بخش فروش</a>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-900">کالاها</span>
                    </nav>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">کالاها</h1>
                </div>
                <a href="{{ route('admin.market.product.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-cyan-600 px-4 py-3 text-sm font-semibold text-white shadow-sm"><i class="fas fa-plus"></i> کالای جدید</a>
            </div>
        </section>

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 p-4">
                <input type="text" placeholder="جستجو" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-cyan-500 focus:bg-white lg:max-w-sm">
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-right">
                    <thead class="bg-slate-50 text-xs font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">#</th>
                            <th class="px-6 py-4">نام کالا</th>
                            <th class="px-6 py-4">تصویر</th>
                            <th class="px-6 py-4">قیمت</th>
                            <th class="px-6 py-4">وزن</th>
                            <th class="px-6 py-4">دسته</th>
                            <th class="px-6 py-4">فرم کالا</th>
                            <th class="px-6 py-4">وضعیت</th>
                            <th class="px-6 py-4">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50/80 align-top">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-600">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $product->name }}</td>
                                <td class="px-6 py-4">
                                    @if(is_array($product->image) && isset($product->image['indexArray'][$product->image['currentImage']]))
                                        <img src="{{ asset($product->image['indexArray'][$product->image['currentImage']]) }}"
                                             data-large="{{ asset($product->image['indexArray']['large']) }}"
                                             alt="{{ $product->name }}"
                                             class="preview-img h-20 w-20 cursor-pointer rounded-2xl object-cover ring-1 ring-slate-200"
                                             loading="lazy">
                                    @else
                                        <span class="text-sm text-slate-400">بدون تصویر</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ number_format($product->price) }} تومان</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $product->weight }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">اندازه نمایشگر</td>
                                <td class="px-6 py-4">
                                    <label class="inline-flex cursor-pointer items-center gap-3">
                                        <input id="{{ $product->id }}" onchange="changeStatus({{ $product->id }})" type="checkbox"
                                               class="h-5 w-5 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                                               @checked($product->status == 1)
                                               data-url="{{ route('admin.market.product.status', $product->id) }}">
                                        <span class="text-sm font-semibold text-slate-700">{{ $product->status == 1 ? 'فعال' : 'غیرفعال' }}</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2 min-w-[22rem]">
                                        <a href="{{ route('admin.market.gallery.index', $product->id) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700"><i class="fas fa-images"></i> گالری</a>
                                        <a href="{{ route('admin.market.color.index', $product->id) }}" class="inline-flex items-center gap-2 rounded-xl bg-cyan-50 px-3 py-2 text-sm font-semibold text-cyan-700"><i class="fas fa-palette"></i> رنگ</a>
                                        <a href="{{ route('admin.market.guarantee.index', $product->id) }}" class="inline-flex items-center gap-2 rounded-xl bg-emerald-50 px-3 py-2 text-sm font-semibold text-emerald-700"><i class="fas fa-shield-alt"></i> گارانتی</a>
                                        <a href="{{ route('admin.market.product.edit', $product->id) }}" class="inline-flex items-center gap-2 rounded-xl bg-amber-50 px-3 py-2 text-sm font-semibold text-amber-700"><i class="fas fa-pen"></i> ویرایش</a>
                                        <form action="{{ route('admin.market.product.destroy', $product->id) }}" method="POST" class="d-none" id="delete-form-{{ $product->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="submit" class="delete inline-flex items-center gap-2 rounded-xl bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700" form="delete-form-{{ $product->id }}" data-id="{{ $product->id }}"><i class="fas fa-trash"></i> حذف</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 p-4">
                {{ $products->links() }}
            </div>
        </section>

        <div id="imageModal" class="modal-overlay">
            <span class="close-btn">&times;</span>
            <img class="modal-content" id="modalImage">
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin-assets/js/modalImage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin-assets/js/status.js') }}"></script>
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection
