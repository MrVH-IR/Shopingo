@extends('customer.layouts.master-two-col')

@section('content')
    <div class="flex flex-col md:flex-row gap-4" x-data="{ showModal: false, showViewModal: false, selectedTicket: null }">
        @include('customer.layouts.aside')
        <div class="w-full lg:w-3/4 p-4">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    <i class="fa-solid fa-ticket text-amber-500 ml-2"></i>
                    تیکت‌های من
                </h2>
                <button @click="showModal = true" class="flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg transition duration-200 shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>ثبت تیکت جدید</span>
                </button>
            </div>
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">موضوع</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">دسته‌بندی</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">اولویت</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">ارجاع به</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">وضعیت</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">دیده شده</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-600">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse ($tickets as $ticket)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-800">{{ $ticket->subject ?? '---' }}</div>
                                    <div class="text-xs text-gray-400 mt-1 line-clamp-1">{{ $ticket->description ?? '' }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $ticket->category->name ?? 'دسته‌بندی نشده' }}</td>
                                <td class="px-4 py-3">
                                    @php
                                        $priorityColors = ['فوری' => 'bg-red-100 text-red-600', 'مهم' => 'bg-orange-100 text-orange-600', 'متوسط' => 'bg-blue-100 text-blue-600', 'کم' => 'bg-gray-100 text-gray-600'];
                                        $priorityName = $ticket->priority->name ?? null;
                                        $priorityClass = $priorityColors[$priorityName] ?? 'bg-gray-100 text-gray-600';
                                    @endphp
                                    <span class="px-2 py-1 rounded-md text-xs font-medium {{ $priorityClass }}">{{ $priorityName ?? 'نامشخص' }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $ticket->admin->name ?? 'ارجاع نشده' }}</td>
                                <td class="px-4 py-3">
                                    @if($ticket->ticket_id !== null)
                                        <span class="px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-600">پاسخ</span>
                                    @else
                                        @if ($ticket->status == 1)
                                            <span class="px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-600">در حال پیگیری</span>
                                        @else
                                            <span class="px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-500">پیگیری شد</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($ticket->seen)
                                        <i class="fa-solid fa-eye text-green-500" title="دیده شده"></i>
                                    @else
                                        <i class="fa-solid fa-eye-slash text-gray-400" title="دیده نشده"></i>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <button @click="selectedTicket = @js($ticket); showViewModal = true" class="text-amber-500 hover:text-amber-600 text-sm font-medium">
                                        مشاهده
                                        <i class="fa-solid fa-arrow-left text-xs mr-1"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center text-gray-400">
                                    <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                    هنوز تیکتی ثبت نکرده‌اید.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;">
                <div @click.outside="showModal = false" x-show="showModal" x-transition class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
                    <button @click="showModal = false" class="absolute top-4 left-4 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">
                        <i class="fa-solid fa-ticket text-amber-500 ml-2"></i>
                        ثبت تیکت جدید
                    </h3>
                    <form action="{{ route('customer.profile.send-ticket') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">موضوع</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 @error('subject') border-red-400 @enderror" placeholder="موضوع تیکت را وارد کنید">
                            @error('subject')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">دسته‌بندی</label>
                            <select name="category_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 @error('category_id') border-red-400 @enderror">
                                <option value="">انتخاب دسته‌بندی</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">اولویت</label>
                            <select name="priority_id" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 @error('priority_id') border-red-400 @enderror">
                                <option value="">انتخاب اولویت</option>
                                @foreach ($priorities as $priority)
                                    <option value="{{ $priority->id }}" @selected(old('priority_id') == $priority->id)>{{ $priority->name }}</option>
                                @endforeach
                            </select>
                            @error('priority_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">توضیحات</label>
                            <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 @error('description') border-red-400 @enderror" placeholder="توضیحات تیکت را بنویسید">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">فایل (اختیاری)</label>
                            <input type="file" name="file" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                        </div>
                        <div class="flex justify-end gap-2 pt-2">
                            <button type="button" @click="showModal = false" class="px-4 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-100">انصراف</button>
                            <button type="submit" class="px-4 py-2 rounded-lg text-sm bg-amber-500 hover:bg-amber-600 text-white">ثبت تیکت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div x-show="showViewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;">
            <div @click.outside="showViewModal = false" x-show="showViewModal" x-transition class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
                <button @click="showViewModal = false" class="absolute top-4 left-4 text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
                <template x-if="selectedTicket">
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                            <i class="fa-solid fa-ticket text-amber-500 ml-2"></i>
                            <span x-text="selectedTicket.subject ?? 'بدون موضوع'"></span>
                        </h3>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">شماره تیکت</span>
                                <span class="font-medium text-gray-700" x-text="selectedTicket.id ?? '---'"></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">مرتبط با تیکت والد</span>
                                <span class="font-medium text-gray-700" x-text="selectedTicket.ticket_id ?? 'ندارد'"></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">دسته‌بندی</span>
                                <span class="font-medium text-gray-700" x-text="selectedTicket.category?.name ?? 'دسته‌بندی نشده'"></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">اولویت</span>
                                <span class="font-medium text-gray-700" x-text="selectedTicket.priority?.name ?? 'نامشخص'"></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">ارجاع به</span>
                                <span class="font-medium text-gray-700" x-text="selectedTicket.admin?.user?.email ?? 'ارجاع نشده'"></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">فرستنده</span>
                                <span class="font-medium text-gray-700" x-text="selectedTicket.user?.email ?? selectedTicket.user?.mobile ?? 'نامشخص'"></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">وضعیت</span>
                                <span
                                    class="font-medium"
                                    :class="selectedTicket.ticket_id ? 'text-blue-600' : (selectedTicket.status == 1 ? 'text-green-600' : 'text-gray-500')"
                                    x-text="selectedTicket.ticket_id ? 'پاسخ داده شده' : (selectedTicket.status == 1 ? 'فعال' : 'غیرفعال')"
                                ></span>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <span class="block text-gray-400 text-xs mb-1">دیده شده</span>
                                <span class="font-medium" :class="selectedTicket.seen ? 'text-green-600' : 'text-gray-400'" x-text="selectedTicket.seen ? 'بله' : 'خیر'"></span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-gray-400 text-xs mb-1">توضیحات</span>
                            <p class="bg-gray-50 rounded-lg p-3 text-sm text-gray-700 leading-relaxed" x-text="selectedTicket.description ?? 'توضیحی ثبت نشده'"></p>
                        </div>
                        <template x-if="selectedTicket.children && selectedTicket.children.length">
                            <div>
                                <span class="block text-gray-400 text-xs mb-1">
                                    پاسخ ادمین
                                </span>

                                <div class="bg-blue-50 border-r-4 border-blue-500 rounded-lg p-3">
                                    <p
                                        class="text-sm text-gray-700 leading-relaxed"
                                        x-text="selectedTicket.children[0].description">
                                    </p>
                                </div>
                            </div>
                        </template>
                        <template x-if="!selectedTicket.children || !selectedTicket.children.length">
                            <div>
                                <span class="block text-gray-400 text-xs mb-1">
                                    پاسخ
                                </span>
                                <p class="bg-gray-50 rounded-lg p-3 text-sm text-gray-500">
                                    هنوز پاسخی ثبت نشده است.
                                </p>
                            </div>
                        </template>
                        <div class="flex justify-end pt-2">
                            <button @click="showViewModal = false" class="px-4 py-2 rounded-lg text-sm bg-gray-100 hover:bg-gray-200 text-gray-600">بستن</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    @if ($tickets->hasPages())
        <div class="mt-4 mb-4 ml-10">
            {{ $tickets->links() }}
        </div>
    @endif
@endsection

@section('script')
    <script>
        document.addEventListener('alpine:init', () => {});
    </script>
@endsection
